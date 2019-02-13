import React from 'react'

export default props =>
    <div className='buttons fadein mb-3'>
        <div className='button'>
            <input type='file' name={'pdf'} accept="application/pdf" className={"hidden"} id='single' onChange={props.onChange} />
            <button className="btn btn-info" onClick={props.onClick}>Upload pdf!</button>
        </div>
    </div>