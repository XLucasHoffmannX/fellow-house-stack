import axios from 'axios'

export const Http = axios.create({
    baseURL: process.env.REACT_APP_URL_ROOT
})