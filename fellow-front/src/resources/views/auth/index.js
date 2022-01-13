import React from 'react';
import { change, login } from '../../../store/actions/auth.action';
import { useSelector, useDispatch } from 'react-redux';
import { Link, Redirect } from 'react-router-dom';

export default function Auth() {
    const dispatch = useDispatch();
    const { credentials, success } = useSelector(state => state.authReducer)

    const handleSubmit = ()=>{
        dispatch(login(credentials))
    }

    return (
        <div className='vh-100 d-flex flex-column align-items-center justify-content-center'>
                <h1 className='mt-5'>Login</h1>
                <form className="w-25">
                    <div>
                        <label className="form-label">Email:</label>
                        <input type="email" className="form-control" value={credentials.email} onChange={text=> dispatch(change({email: text.target.value}))} required/>
                    </div>
                    <div className='mt-3'>
                        <label className="form-label">Senha:</label>
                        <input type="password" className="form-control" value={credentials.password} onChange={text=> dispatch(change({password: text.target.value}))} required/>
                    </div>
                    <div className='mt-3'>
                        <span>Sem conta ainda? <Link to="/register">Cadastra-se aqui</Link></span>
                    </div>
                    <div className='mt-3 d-flex flex-column flex-row-reverse'>
                        <button onClick={handleSubmit} className="btn btn-primary" type="button">Entrar</button>
                    </div>
                </form>
                {
                    success && <Redirect to="/home" />
                }
        </div>
    )
}
