import $store from "@store/utils/crud";

const canAccess = (to) => {
    if (to.meta?.roles) {
        return to.meta.roles.includes($store.getters['app_store/userRole'])
    }
    return true
}