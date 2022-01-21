import axios from 'axios'

export const Http = axios.create({
    baseURL: process.env.REACT_APP_URL_ROOT
})

export const HttpAuth = axios.create({
    baseURL: process.env.REACT_APP_URL_ROOT_API
})

/* request */
HttpAuth.interceptors.request.use(
    async (config) => {
        config.headers.authorization = `Bearer ${await localStorage.getItem('access_token')}`;

        return config
    }
);

/* response */
HttpAuth.interceptors.response.use( res => {return res}, error=>{
    if(error.response){
        if(error.response.status === 401) {
            localStorage.removeItem('access_token');

            window.location.replace('login');
        }
    }
})