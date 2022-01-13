import React from 'react'

export function NotFound() {
    return (
        <div className='vh-100 d-flex flex-column align-items-center justify-content-center'>
            <div className='d-flex flex-column align-items-center'>
                <h1>404</h1>
                <h2>Página não encontrada!</h2>
            </div>
        </div>
    )
}

export function AuthError(){
    return (
        <div className='vh-100 d-flex flex-column align-items-center justify-content-center'>
            <div className='d-flex flex-column align-items-center'>
                <h1>401</h1>
                <h2>Página não autorizada!</h2>
            </div>
        </div>
    )
}
