import { combineReducers } from "redux";

/* reducers combined */
import loadingReducer from "./combined/loading.reducer";
import notifyReducer from "./combined/notify.reducer";
import authReducer from "./combined/auth.reducer";
import registerReducer from "./combined/register.reducer";

const rootReducer = combineReducers({
    loadingReducer,
    notifyReducer,
    authReducer,
    registerReducer
})

export default rootReducer;