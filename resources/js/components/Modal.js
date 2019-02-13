import React from 'react';

const Modal = ({ openModal, closeModal, pdfLink }) => {
    const showHideClassName = openModal ? "modal fade show modal-show" : "modal fade";

    return (
        <div className="modal-backdrop">
            <div className={showHideClassName} role="dialog">
                <div className="modal-dialog modal-lg" role="document">
                    <div className="modal-content">
                        <div className="modal-header">
                            <button type="button" className="close" data-dismiss="modal" onClick={closeModal} aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div className="modal-body">
                            <object className="pdf-object" data={`storage/${pdfLink}`} type="application/pdf">
                                <embed src={`storage/${pdfLink}`} type="application/pdf" />
                            </object>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Modal;