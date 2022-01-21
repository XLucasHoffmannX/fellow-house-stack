import { actionTypes } from '../../actions/auth.action';

const access = localStorage.getItem('access_token');
let authorization;

access ? authorization = true : authorization = false;

const initialState = {
    credentials: {
        email: '',
        password: ''
    },
    success: false,
    logged: authorization,
    user: {}
}

// eslint-disable-next-line
export default (state = initialState, { type, payload }) => {
    switch (type) {

        case actionTypes.CHANGE:
            return {
                ...state,
                credentials: {
                    ...state.credentials,
                    ...payload
                }
            }
        case actionTypes.USER:
            return {
                ...state,
                user: payload
            }

        case actionTypes.SUCCESS:
            return {
                ...state,
                success: payload
            }

        case actionTypes.LOGGED:
            return {
                ...state,
                logged: payload
            }

        default:
            return state
    }
}