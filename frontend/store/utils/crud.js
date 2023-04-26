import {apiRequest} from "../axios";
import {integer} from "@vee-validate/rules";

export default (modelName) => {
    return {
        name: modelName + '_store',
        namespaced: true,
        state: {
            items: [],
            item: {},
            pagination: {
                page: 1,
                perPage: 10,
                total: 0,
                totalPages: 0,
            }
        },
        mutations: {
            SET_ITEMS(state, payload) {
                // Find items in state.items that are in payload
                // and update them
                // Set updated items to state.items
                state.items = state.items.map((item) => {
                    let updatedItem = payload['hydra:member'].find((p) => p.id === item.id);
                    if (updatedItem) {
                        return updatedItem;
                    }
                    return item;
                });

                // Add items to state.items that are not in state.items
                payload['hydra:member'].forEach((item) => {
                    if (!state.items.find((i) => i.id === item.id)) {
                        state.items.push(item);
                    }
                });

                // Set pagination
                if (payload['hydra:view']['hydra:last']) {
                    state.pagination.totalPages = Number(payload['hydra:view']['hydra:last'].split('page=')[1]);
                }
                state.pagination.total = payload['hydra:totalItems'];
            },
            SET_ITEM(state, payload = {id: this.$router.params.id}) {
                // Find item in state.items that is in payload
                // and update it
                // Set updated item to state.item
                state.item = payload;

                let updatedItem = state.items.find((item) => item.id === payload.id);
                if (updatedItem) {
                    updatedItem = payload;
                }

                // Update items in state.items
                state.items = state.items.map((item) => {
                    if (item.id === payload.id) {
                        return payload;
                    }
                    return item;
                });
            },
        },
        actions: {
            fetchItems({ commit }, payload) {
                return new apiRequest(
                    modelName,
                    'GET',
                    (response) => {
                        commit('SET_ITEMS', response.data);
                    },
                    payload
                );
            },
            fetchItem({ commit }, payload) {
                // Delete id from payload
                let params;
                params = {...payload};
                delete params.id;

                return new apiRequest(
                    modelName + '/' + payload.id,
                    'GET',
                    (response) => {
                        commit('SET_ITEM', response.data);
                    },
                    params
                );
            },
            createItem({ commit }, payload) {
                return new apiRequest(
                    modelName,
                    'POST',
                    (response) => {
                        commit('SET_ITEM', response.data);
                    },
                    payload
                );
            },
            updateItem({ commit }, payload) {
                return new apiRequest(
                    modelName + '/' + payload.id,
                    'PUT',
                    (response) => {
                        commit('SET_ITEM', response.data);
                    },
                    payload
                );
            },
            deleteItem({ commit }, payload) {
                return new apiRequest(
                    modelName + '/' + payload.id,
                    'DELETE',
                    (response) => {
                        commit('SET_ITEM', response.data);
                    },
                    payload
                );
            }
        },
        getters: {
            getItems(state) {
                return state.items;
            },
            getItem(state) {
                return state.item;
            },
            getPagination(state) {
                return state.pagination;
            }
        },
    }
}
