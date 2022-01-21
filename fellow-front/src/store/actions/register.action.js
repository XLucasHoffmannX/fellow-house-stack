import { Http } from '../../config/Http';
import { changeLoading } from '../actions/loading.action';
import { changeNotify } from '../actions/notify.action';
import { logged } from './auth.action';

export const actionTypes = {
    CHANGE: 'REGISTER_CHANGE',
    ERROR: 'REGISTER_ERROR',
    SUCCESS: 'REGISTER_SUCCESS'
}

export const change = (payload) => ({
    type: actionTypes.CHANGE,
    payload
})

export const errors = (payload) => ({
    type: actionTypes.ERROR,
    payload
})

export const success = (payload) => ({
    type: actionTypes.SUCCESS,
    payload
})

export const setUserToken = token => async dispatch => {
    localStorage.setItem('access_token', token);
    dispatch(change({
        name: '',
        email: '',
        password: ''
    }))

    dispatch(success(true));
    dispatch(logged(true));
}

export const register = data => async dispatch => {
    dispatch(changeLoading({
        open: true,
        msg: 'Cadastrando usuário...'
    }));

    return await Http.post('/api/user/register', data)
        .then(res => {
            dispatch(changeLoading({ open: false }))
            if (typeof res !== 'undefined') {
                if (res.data.access_token) {
                    dispatch(changeNotify({
                        open: true,
                        class: 'success',
                        message: 'Usuário cadastrado com sucesso, bem vindo!'
                    }))

                    dispatch(setUserToken(res.data.access_token))
                }
            }
        })
        .catch(error => {
            dispatch(changeLoading({ open: false }))
            if (typeof error.response !== 'undefined') {
                if (error.response) {
                    dispatch(errors(error.response.data.errors))
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