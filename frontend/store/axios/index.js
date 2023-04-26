import axios from "axios";

const apiRequest = (url, method = 'GET', onSuccess = () => {}, data = null, headers = { 'accept': 'application/ld+json' }) => {
    url = '/api/' + url;

    if (!['GET', 'POST', 'PUT', 'DELETE', 'PATCH'].includes(method)) {
        method = 'GET';
    }

    if (method === 'GET') {
        // Format data to query string
        let queryString = '';
        if (data) {
            queryString = Object.keys(data).map(key => key + '=' + data[key]).join('&');
        }
        if (queryString) {
            url += '?' + queryString;
        }
    }

    return new Promise((resolve, reject) => {
        axios({
            url,
            method,
            data: data,
            headers
        })
            .then((response) => {
                onSuccess && onSuccess(response);
                resolve(response.data['hydra:member'] || response.data || response);
            })
            .catch((error) => {
                reject(error);
            });
    });
}

export {
    apiRequest
};
