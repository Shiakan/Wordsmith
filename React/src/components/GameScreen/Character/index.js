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
    onMovePlayer: PropTypes.func.isRequired,
    name: PropTypes.string.isRequired,
    id: PropTypes.string.isRequired,
    color: PropTypes.string.isRequired,
    deletePlayer: PropTypes.func.isRequired,
  }

  componentDidMount() {
    console.log('Character loaded');
  }

  movePlayer = (e) => {
    console.log(e.target.id);
    const { onMovePlayer } = this.props;
    onMovePlayer(e);
  }

  render() {
    const {
      name, color, id, deletePlayer,
    } = this.props;
    return (
      <Draggable
        onStop={this.movePlayer}
        bounds="parent"
      >
        <div
          className="character"
          style={{
            position: 'absolute',
          }}
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
