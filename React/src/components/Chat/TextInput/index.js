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
import './textInput.sass';

/**
 * Code
 */
class TextInput extends React.Component {
  static propTypes = {
    message: PropTypes.string,
    onInputChange: PropTypes.func.isRequired,
    onAddMessage: PropTypes.func.isRequired,
  };

  static defaultProps = {
    message: '',
  };

  handleChange = (evt) => {
    // On récupère la fonction dans les props depuis le container grâce à Redux
    const { onInputChange } = this.props;
    const { value } = evt.target;
    onInputChange(value);
  }

  handleSubmit = (evt) => {
    // On empêche le comportement par défaut
    evt.preventDefault();
    // Je décompose les props, je prends ce dont j'ai besoin
    const { onAddMessage } = this.props;
    // On execute la prop transmise par App
    onAddMessage();
  }

  render() {
    const { message } = this.props;

    return (
      <div className="form">
        <form autoComplete="off" onSubmit={this.handleSubmit}>
          <input
            className="form-input"
            type="text"
            placeholder="Votre message"
            value={message}
            onChange={this.handleChange}
          />
        </form>
      </div>
    );
  }
}


/**
 * Export
 */
export default TextInput;
