import React from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { CircularProgress } from '@material-ui/core';
import { setUser } from '../../../store/actions/auth.action';

export default function Home() {
    const dispatch = useDispatch();
    const state = useSelector(state => state.authReducer);

    const [assets, setAssets] = React.useState({
        isLoading: true,
        redirect: false,
        user: []
    });

    const index = async () => {
        if (state.logged) {
            dispatch(setUser())
                .then(res => {
                    setAssets({ isLoading: false })
                })
        }
    }

    React.useEffect(() => {
        index();
    }, [])

    return (
        <div>
            {(assets.isLoading) ? <div><div className="vh-100 d-flex justify-content-center align-items-center"><CircularProgress /></div></div> :
                <div>
                    <h1>Bem vindo! <span>{state.user.name}</span></h1>
                    <span>Username: {state.user.username} </span>
                    <br /> 
                    <span>Id de usuário: {state.user.id} </span> 
                    <br /> 
                    <span>Email: {state.user.email} </span>
                </div>
            }
        </div>
    )
}
