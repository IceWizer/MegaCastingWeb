import { apiRequest } from "@store/axios";

export default ({
    name: 'auth_store',
    state: {

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

    },
    namespaced: true,
})
