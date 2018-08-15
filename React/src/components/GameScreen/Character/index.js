/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import Draggable from 'react-draggable';


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
    movePlayer: PropTypes.func.isRequired,
    name: PropTypes.string.isRequired,
    id: PropTypes.string.isRequired,
    color: PropTypes.string.isRequired,
    deletePlayer: PropTypes.func.isRequired,
    coordX: PropTypes.number.isRequired,
    coordY: PropTypes.number.isRequired,
  }

  componentDidMount() {
    console.log('Character loaded');
  }

  movePlayer = (e) => {
    console.log(e.target.id);
    const { movePlayer } = this.props;
    movePlayer(e);
  }

  render() {
    const {
      name, color, id, deletePlayer, coordX, coordY,
    } = this.props;
    return (
      <Draggable
        onStop={this.movePlayer}
        bounds="parent"
        defaultPosition={{ x: coordX, y: coordY }}
        handle=".character-cursor"
      >
        <div
          className="character"
        >
          <div
            className="character-nickname"
            style={{
              color,
            }}
          >{name}
            <button
              type="button"
              className="character-nickname-delete"
              onClick={deletePlayer}
            >X
            </button>
          </div>
          <div
            className="character-cursor"
            id={id}
            style={{
              backgroundColor: color,
            }}
          />
        </div>
      </Draggable>

    );
  }
}

/**
 * Export
 */
export default Character;
