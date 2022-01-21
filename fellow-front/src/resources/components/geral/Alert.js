import React, { useState } from 'react';
import { changeAlert } from '../../../store/actions/alert.action';
import { Modal, Typography } from '@material-ui/core';
import { useDispatch, useSelector } from 'react-redux';
import { MdError, MdCheckCircle } from 'react-icons/md';

export default function Alert() {
    const dispatch = useDispatch();
    const alert = useSelector(state => state.alertReducer)

    if (alert.open) {
        setTimeout(() => dispatch(changeAlert({ open: false })), alert.time);
    }

    return (
        <Modal
            open={alert.open}
            onClose={() => dispatch(changeAlert({ open: false }))}
            className="d-flex flex-column align-items-center justify-content-center h-100"
        >
            <div className="bg-white rounded d-flex align-items-center p-3">
                {
                    (alert.class === 'success') &&
                    <MdCheckCircle style={{ fontSize: '2.5rem', marginRight: '1rem' }} className="mr-3 text-success" />
                }
                {
                    (alert.class === 'error') &&
                    <MdError style={{ fontSize: '2.5rem', marginRight: '1rem' }} className="mr-3 text-danger" />
                }
                <Typography className="font-weight-bold" variant="subtitle2">
                    {alert.message}
                </Typography>
            </div>
        </Modal>
    );
}
