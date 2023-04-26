import {getData, removeJwt, setJwt} from "@/auth/utils/useJwt";
import {removeUserData, setUserData} from "@/auth/utils/useUserData";
import {apiRequest} from "../../store/axios";

const login = (jwt) => {
    setJwt(jwt);
    setUserData(getData());
    setUserId();
}

const logout = () => {
    removeJwt();
    removeUserData();
    removeUserId();
}

const setUserId = () => {

    new apiRequest(
        'users/get-id',
        'GET',
    )
    .then(response => {
        localStorage.setItem('userId', response.id);
    });
}

const removeUserId = () => {
    localStorage.removeItem('userId');
}

const getUserId = () => {
    return localStorage.getItem('userId');
}


export {
    login,
    logout,
    getUserId
}
