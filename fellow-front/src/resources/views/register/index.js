import React from 'react';
import { Link, Redirect } from 'react-router-dom';
import { change, register } from '../../../store/actions/register.action';
import { useDispatch, useSelector } from 'react-redux';

export default function Register() {
    const dispatch = useDispatch();
    const { user, error, success } = useSelector(store => store.registerReducer);

    const handleRegister = () => {
        dispatch(register(user));
    }

    return (
        <div className='vh-100 d-flex flex-column align-items-center justify-content-center'>
            <h1 className='mt-5'>Cadastro</h1>
            <form className="w-25">
                <div>
                    <label className="form-label">Nome completo:</label>
                    <input type="text" className="form-control" value={user.name || ''} required
                        onChange={
                            text => {
                                dispatch(change({ name: text.target.value }));
                                if (error.name && delete error.name);
                            }
                        }
                    />
                </div>
                {(error.name) &&
                    <strong className="text-danger">{error.name[0]}</strong>
                }
                <div className='mt-3'>
                    <label className="form-label">Email:</label>
                    <input type="email" className="form-control" value={user.email || ''} required
                        onChange={
                            text => {
                                dispatch(change({ email: text.target.value }))
                                if (error.email && delete error.email);
                            }
                        }
                    />
                </div>
                {(error.email) &&
                    <strong className="text-danger">{error.email[0]}</strong>
                }
                <div className='mt-3'>
                    <label className="form-label">Nome de Usuário:</label>
                    <input type="text" className="form-control" value={user.username || ''} required
                        onChange={
                            text => {
                                dispatch(change({ username: text.target.value }))
                                if (error.username && delete error.username);
                            }
                        }
                    />
                </div>
                {(error.username) &&
                    <strong className="text-danger">{error.username[0]}</strong>
                }
                <div className='mt-3'>
                    <label className="form-label">Senha:</label>
                    <input type="password" className="form-control" value={user.password || ''} required
                        onChange={
                            text => {
                                dispatch(change({ password: text.target.value }))
                                if (error.password && delete error.password);
                            }
                        }
                    />
                </div>
                {(error.password) &&
                    <strong className="text-danger">{error.password[0]}</strong>
                }
                <div className='mt-3'>
                    <span>Já possui conta? <Link to="/">Entre aqui</Link></span>
                </div>
                <div className='mt-3 d-flex flex-column flex-row-reverse'>
                    <button onClick={handleRegister} className="btn btn-primary" type="button">Começar</button>
                </div>
            </form>
            {(success) &&
                <Redirect to="/home" />
            }
        </div>
    )
}
