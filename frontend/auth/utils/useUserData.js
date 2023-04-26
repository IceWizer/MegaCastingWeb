import {getJwt, isJwtExpired, removeJwt} from "@/auth/utils/useJwt";
import {getUserId, logout} from "./connection";

const isUserLoggedIn = () => {
    const user = getUserData();

    let isLogged = !!user && !isJwtExpired() && !!getUserId();

    if (!isLogged) {
        removeUserData();
        removeJwt();
        logout();
    }

    return isLogged;
}

const getUserData = (isInRecursive = false) => {
    const user = localStorage.getItem('user');
    if (user) {
        return JSON.parse(user);
    }
    if (!isInRecursive) {
        setUserData(getJwt());
        return getUserData(true)
    }
    return null;
}

const setUserData = (user) => {
    localStorage.setItem('user', JSON.stringify(user));
}

const removeUserData = () => {
    localStorage.removeItem('user');
}

const isUserAdmin = () => {
    const user = getUserData();
    return user?.roles && (user.roles.includes('ROLE_ADMIN') || user.roles.includes('ROLE_SUPER_ADMIN'));
}

export {
    isUserLoggedIn,
    getUserData,
    setUserData,
    removeUserData,
    isUserAdmin
}
