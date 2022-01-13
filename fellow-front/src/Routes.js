import React, { lazy, Suspense/* , lazy  */} from "react";
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import { CircularProgress } from "@material-ui/core";
import { useSelector } from 'react-redux';
import { AuthError, NotFound } from "./resources/components/error";


const Auth = lazy(()=> import("./resources/views/auth/index"));
const Register = lazy(()=> import("./resources/views/register/index"));
const Home = lazy(()=> import("./resources/views/home/index"));

const Routes = () => {
    const { logged } = useSelector(state => state.authReducer)

    React.useEffect(()=>{ console.log(logged) }, [logged])

    return (
        <Router>
            <Suspense fallback={<div><div className="vh-100 d-flex justify-content-center align-items-center"><CircularProgress /></div></div>}>
                <Switch>
                    {/* <Route exact path="/" component={} /> */}
                    <Route exact path="/" component={Auth} />

                    <Route exact path="/register" component={Register} />

                    <Route exact path="/home" component={logged ? Home : AuthError}/>

                    <Route  path="*" exact component={NotFound}/>
                </Switch>
            </Suspense>
        </Router>
    )
}

export default Routes;