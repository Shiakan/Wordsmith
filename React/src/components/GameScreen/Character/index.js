/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';


/**
 * Local import
 */
// Composants

// Styles et assets
import './character.sass';

/**
 * Code
 */
class Character extends React.Component {
  static propTypes = {
    name: PropTypes.string.isRequired,
    color: PropTypes.string.isRequired,
    coordX: PropTypes.number.isRequired,
    coordY: PropTypes.number.isRequired,
  }

  componentDidMount() {
    console.log('Character loaded');
  }

  render() {
    const {
      name, color, coordX, coordY,
    } = this.props;
    return (
      <div
        className="character"
        style={{
          position: 'absolute',
          left: `${coordX - 25}px`,
          top: `${coordY - 50}px`,
        }}
      >
        <span
          className="character-nickname"
          style={{
            color,
          }}
        >{name}
        </span>
        <div
          className="character-cursor"
          style={{
            backgroundColor: color,
          }}
        />
      </div>
    );
  }
}

/**
 * Export
 */
export default Character;
