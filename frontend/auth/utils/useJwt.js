const isJwtExpired = (jwt = getJwt()) => {
    const jwtParts = jwt.split('.');
    const payload = JSON.parse(atob(jwtParts[1]));
    const expirationDate = new Date(payload.exp * 1000);
    return expirationDate < new Date();
}

const getData = (jwt = getJwt()) => {
    const jwtParts = jwt.split('.');
    return JSON.parse(atob(jwtParts[1]));
}

const getJwt = () => {
    return localStorage.getItem('token');
}

const setJwt = (jwt) => {
    localStorage.setItem('token', jwt);
}

const removeJwt = () => {
    localStorage.removeItem('token');
}

export {
    isJwtExpired,
    getData,
    getJwt,
    setJwt,
    removeJwt
}
