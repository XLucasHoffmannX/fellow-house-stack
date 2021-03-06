import { combineReducers } from "redux";

/* reducers combined */
import loadingReducer from "./combined/loading.reducer";
import notifyReducer from "./combined/notify.reducer";
import authReducer from "./combined/auth.reducer";
import registerReducer from "./combined/register.reducer";
import alertReducer from "./combined/alert.reducer";

const rootReducer = combineReducers({
    authReducer,
    loadingReducer,
    notifyReducer,
    registerReducer, 
    alertReducer
})

export default rootReducer;