/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';

/**
 * Local import
 */
// Components

// Style
import './messages.sass';

/**
 * Code
 */
class Messages extends React.Component {
  static propTypes = {
    messages: PropTypes.array/* Of(PropTypes.object.isRequired) */.isRequired,
  };

  // static defaultProps = {
  //   messages: [],
  // };

  componentDidUpdate() {
    console.log('Message didMount');
    this.messageDiv.scrollTo(0, this.messageDiv.scrollHeight);
  }

  saveRef = (domElement) => {
    this.node = domElement;
  }

  render() {
    const { messages } = this.props;
    console.log(messages);
    return (
      <div
        ref={this.saveRef}
        className="messages"
      >
        {messages.map((message) => {
          return (
            <div className="message" key={message.id}>
              {/* <p className="message-auteur">{message.auteur}</p> */}
              {console.log(message)}
              <p className="message-content">{message.message}</p>
            </div>
          );
        })}
      </div>
    );
  }
}


/**
 * Export
 */
export default Messages;
