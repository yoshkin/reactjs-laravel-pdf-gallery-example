import React, {Fragment} from 'react';
import Document from './Document'

class DocumentsList extends React.Component {
    buildDocumentsList (documents) {
        return documents.map(document => (
            this.renderDocument(document)
        ))
    }
    renderDocument(document) {
        return <Document key={document.id} onClick={() => this.props.onClick(document.attachment)} document={document} />
    }

    render() {
        return (
            <Fragment>
                {this.buildDocumentsList(this.props.documents)}
            </Fragment>
        );
    }
}

export default DocumentsList;