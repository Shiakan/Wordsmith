/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import { CirclePicker } from 'react-color';


/**
 * Local import
 */
// Composants

// Styles et assets
import './switchmj.sass';

/**
 * Code
 */
class SwitchMJ extends React.Component {
  static propTypes = {
    togglePicker: PropTypes.func.isRequired,
    onChangeColor: PropTypes.func.isRequired,
    onInputChange: PropTypes.func.isRequired,
    color: PropTypes.string.isRequired,
    toggle: PropTypes.bool.isRequired,
    typingName: PropTypes.string,
    createPlayer: PropTypes.func.isRequired,
  }

  static defaultProps = {
    typingName: '',
  };

  componentDidMount() {
    console.log('switch MJ loaded');
  }

  handleChange = (e) => {
    const { onInputChange } = this.props;
    const { value } = e.target;
    onInputChange(value);
  }

  handleSubmit = (e) => {
    e.preventDefault();
    const { createPlayer } = this.props;
    createPlayer();
  }

  changeColor = (color) => {
    const { onChangeColor, togglePicker } = this.props;
    onChangeColor(color.hex);
    togglePicker();
  }

  render() {
    const {
      togglePicker, color, toggle, typingName,
    } = this.props;
    return (
      <div className="mjSwitch">
        {toggle
          && (
          <CirclePicker
            className="mjSwitch-picker"
            color={color}
            circleSize={17}
            circleSpacing={10}
            width="170px"
            onChange={this.changeColor}
            triangle="hide"
          />
          )}
        <form className="mjSwitch-form" onSubmit={this.handleSubmit}>
          <button
            type="button"
            style={{ backgroundColor: color }}
            onClick={togglePicker}
          >
          &nbsp;
          </button>
          <input
            className="mjSwitch-input"
            type="text"
            placeholder="Nom du personnage"
            onChange={this.handleChange}
            value={typingName}
          />
          <input
            className="mjSwitch-button"
            type="submit"
            value="+"
          />
        </form>
      </div>
    );
  }
}

/**
 * Export
 */
export default SwitchMJ;
