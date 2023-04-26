import { apiRequest } from "@store/axios";

export default ({
    state: {
        window: {
            width: 0,
            height: 0,
            smallWidth: 1200,
        }
    },
    mutations: {
        setWidth(state, width) { state.window.width = width },
        setHeight(state, height) { state.window.height = height },
        setSmallWidth(state, smallWidth) { state.window.smallWidth = smallWidth },
    },
    actions: {
        setWidth({ commit }, width) { commit('setWidth', width) },
        setHeight({ commit }, height) { commit('setHeight', height) },
        setSmallWidth({ commit }, smallWidth) { commit('setSmallWidth', smallWidth) },
    },
    getters: {
        getWidth: state => state.window.width,
        getHeight: state => state.window.height,
        getSmallWidth: state => state.window.smallWidth,
        isSmall: state => state.window.width < state.window.smallWidth,
    },
    namespaced: true,
})
