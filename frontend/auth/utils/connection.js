import {getData, removeJwt, setJwt} from "@/auth/utils/useJwt";
import {removeUserData, setUserData} from "@/auth/utils/useUserData";

const login = (jwt) => {
    setJwt(jwt);
    setUserData(getData());
}

const logout = () => {
    removeJwt();
    removeUserData();
}

const getUserId = () => {
    const user = getData();
    return user?.id;
}


export {
    login,
    logout,
    getUserId
}
