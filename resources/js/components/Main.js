import React, { Component, Fragment } from 'react';
import ReactDOM from 'react-dom';
import {NotificationContainer, NotificationManager} from 'react-notifications';
import DocumentsList from "./DocumentsList";
import Buttons from "./Buttons";
import Modal from './Modal';
import {config} from "./Config";

export default class Main extends Component {
    constructor() {
        super();
        //Initialize the state in the constructor
        this.state = {
            documents: [],
            uploading: false,
            showModal: false,
            pdfLink: '',
        }
    }
    /* componentDidMount() is a lifecycle method
     * that gets called after the component is rendered
     */
    componentDidMount() {
        this.fetchDocuments()
    }

    fetchDocuments() {
        this.setState({...this.state})
        fetch(config.url)
            .then(response => response.json())
            .then(result => this.setState({documents: result.data}))
            .catch(e => console.log(e));
    }

    onClickHandler = () => {
        document.getElementById('single').click()
    }

    onChangeHandler = (e) => {
        const files = Array.from(e.target.files)
        this.setState({ uploading: true })

        const formData = new FormData()
        formData.append('pdf', files[0])

        fetch(config.url, {
            method: 'POST',
            body: formData
        })
            .then(res => res.json())
            .then(document => {
                if (document.success) {
                    this.setState({
                        uploading: false,
                        documents: [...this.state.documents, document.data]
                    })
                    NotificationManager.success('Documents list updated', 'PDF file uploaded', 3000);
                } else {
                    this.setState({
                        uploading: false,
                    })
                    throw new Error(document.message)
                }
            })
            .catch(e => {
                console.log(e)
                NotificationManager.error(e.message, 'Error!', 5000);
            });
    }

    toggleShowModal() {
        this.setState((state) => {
            return {showModal: !state.showModal}
        });
    }
    openModal = (pdf) => {
        this.toggleShowModal()
        this.setState({pdfLink: pdf});
    }
    closeModal = () => {
        this.toggleShowModal()
        this.setState({pdfLink: ''});
    }


    render() {
        const { uploading, documents } = this.state
        const content = () => {
            switch(true) {
                case uploading:
                    return <p>Uploading...</p>
                default:
                    return <Buttons onClick={this.onClickHandler} onChange={this.onChangeHandler} />
            }
        }
        return (
            <div className={"container"}>
                <div className={"col-md-12"}>
                    <div className={"buttons mb-3"}>
                        {content()}
                    </div>
                    <Fragment>
                        { this.state.showModal && <Modal openModal={this.openModal} closeModal={this.closeModal} pdfLink={this.state.pdfLink}/> }
                    </Fragment>
                    <div className={"row documentsList"}>
                        <DocumentsList onClick={(pdfLink) => this.openModal(pdfLink)} documents={documents} />
                    </div>
                </div>
                <NotificationContainer/>
            </div>
        );
    }
}

if (document.getElementById('root')) {
    ReactDOM.render(<Main />, document.getElementById('root'));
}
