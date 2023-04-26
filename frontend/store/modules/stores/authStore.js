import { apiRequest } from "@store/axios";

export default ({
    state: {
        user: null,
    },
    mutations: {

    },
    actions: {
        register({ commit }, payload) {
            return apiRequest(
                'auth/register',
                'POST',
                null,
                payload
            )
        },
        login({ commit }, payload) {
            return apiRequest(
                'auth/login',
                'POST',
                null,
                payload
            )
        },
        logout({ commit }) {
            return apiRequest(
                'auth/logout',
                'POST',
                null,
                null
            )
        }
    },
    getters: {
        getUser(state) {
            return state.user;
        }
    },
    namespaced: true,
})
