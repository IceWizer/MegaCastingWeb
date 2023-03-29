import Vuex from 'vuex'

import authStore from './modules/stores/authStore'

export default new Vuex.Store({
    modules: {
        authStore,
    },
})
