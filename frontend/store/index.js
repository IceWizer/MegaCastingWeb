import Vuex from 'vuex'

import appStore from './modules/stores/app'
import authStore from './modules/stores/authStore'
import castingOfferStore from './modules/stores/castingOfferStore'
import contractTypeStore from "./modules/stores/contractTypeStore";
import jobDomainStore from "./modules/stores/jobDomainStore";
import jobStore from "./modules/stores/jobStore";
import userStore from './modules/stores/userStore'

export default new Vuex.Store({
    modules: {
        app_store: appStore,
        auth_store: authStore,
        casting_offers_store: castingOfferStore.store,
        contract_types_store: contractTypeStore.store,
        job_domains_store: jobDomainStore.store,
        jobs_store: jobStore.store,
        users_store: userStore.store,
    },
})
