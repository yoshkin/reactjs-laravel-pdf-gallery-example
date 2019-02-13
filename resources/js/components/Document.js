import React from 'react';

const Document = (props) => {
    return (
        <div onClick={props.onClick} className={"col-md-3 mb-3"} key={props.document.id}>
            <img className={"embed-responsive"} src={"storage/" + props.document.preview} alt=""/>
        </div>
    );
};

export default Document;