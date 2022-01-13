import { actionTypes } from "../../actions/notify.action"

const initialState = {
    open: false,
    horizontal: 'right',
    vertical: 'top',
    class: 'success',
    time: 3000,
    message: 'Operação concluída'
}

export default (state = initialState, { type, payload }) => {
    switch (type) {

    case actionTypes.CHANGE:
        return { ...state, ...payload }

    default:
        return state
    }
}
