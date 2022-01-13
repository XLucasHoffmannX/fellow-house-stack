import React from 'react';
import { Typography, CircularProgress, Modal, formatMs } from '@material-ui/core';
import { changeLoading } from '../../../store/actions/loading.action';
import { useSelector, useDispatch } from 'react-redux';

export default function Loading() {
    const dispatch = useDispatch();
    const loading = useSelector(state => state.loadingReducer)

    return (
        <Modal
            open={loading.open}
            onClose={()=> dispatch( changeLoading({open: false}) )}
            className="outlined d-flex justify-content-center align-items-center"
        >   
            <div className="bg-white d-flex align-items-center rounded p-3 outlined" >
                <CircularProgress size={30} style={{marginRight: '1rem'}} />
                <Typography variant="subtitle1">{loading.message}</Typography>
            </div>
        </Modal>
    )
}
