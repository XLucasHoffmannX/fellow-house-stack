import { changeLoading } from '../actions/loading.action';
import { changeNotify } from '../actions/notify.action';
import { Http, HttpAuth } from '../../config/Http';

export const actionTypes = {
    CHANGE: 'AUTH_CHANGE',
    SUCCESS: 'AUTH_SUCCESS',
    LOGGED: 'AUTH_LOGGED',
    USER: 'AUTH_USER'
}

export const change = payload => ({
    type: actionTypes.CHANGE,
    payload
})

export const success = payload => ({
    type: actionTypes.SUCCESS,
    payload
})

export const logged = payload => ({
    type: actionTypes.LOGGED,
    payload
})

export const user = payload => ({
    type: actionTypes.USER,
    payload
})

export const setUser =  () => dispatch => {
    return HttpAuth.get('/user')
        .then(res => {
            dispatch(user(res.data.userAuth))
            if(res.data.userAuth.verify === 0){
                dispatch(changeNotify({
                    open: true,
                    message: `${res.data.userAuth.name} você precisa terminar suas configurações`
                }));
            }
        })
}

export const setUserToken = token => async dispatch => {
    localStorage.setItem('access_token', token);

    dispatch(change({
        email: '',
        password: ''
    }))// apos auth limpar campos

    dispatch(success(true))
    dispatch(logged(true))
}

export const login = credentials => dispatch => {
    dispatch(changeLoading({
        open: true,
        message: 'Autenticando usuário'
    }))

    // authentication
    return Http.post('/oauth/token', {
        grant_type: "password",
        client_id: process.env.REACT_APP_CLIENT_ID,
        client_secret: process.env.REACT_APP_CLIENT_SECRET,
        username: credentials.email,
        password: credentials.password,
        scope: ""
    }).then(res => {
        dispatch(
            changeNotify({
                open: true,
                class: 'success',
                message: 'Login realizado com sucesso!'
            })
        )
        dispatch(
            changeLoading({ open: false })
        );

        if (typeof res !== 'undefined') {
            if (res.data.access_token) {
                dispatch(setUserToken(res.data.access_token))
            }
        }
    }).catch(err => {
        dispatch(changeLoading({ open: false }));

        if (typeof err.response !== 'undefined') {
            if (err.response.status === 401 || err.response.status === 400) {
                dispatch(changeNotify({
                    open: true,
                    class: 'error',
                    message: 'E-mail ou senha incorretos!'
                }))
            }
        } else {
            dispatch(changeNotify({
                open: true,
                class: 'error',
                message: 'Erro encontrado, tente novamente mais tarde!'
            }))
        }
    })
}