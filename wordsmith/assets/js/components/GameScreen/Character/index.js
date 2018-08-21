/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import Draggable from 'react-draggable';
import { TiDelete } from 'react-icons/ti';
import classNames from 'classnames';


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
    userName: PropTypes.string.isRequired,
    role: PropTypes.string.isRequired,
  }

  componentDidMount() {
    console.log('Character loaded');
  }


  movePlayer = (e) => {
    console.log(e, 'EEE');
    const { movePlayer } = this.props;
    movePlayer(e);
  }


  render() {
    const {
      name, color, id, deletePlayer, coordX, coordY, userName, role,
    } = this.props;
    console.log(userName, role);
    const mjCheck = (role === 'dm');
    const userCheck = (name === userName);
    console.log('bool :', userCheck);

    const userClass = classNames(
      'character-cursor',
      {
        'character-cursor-other': !userCheck && !mjCheck,

      },
    );
    return (
      <Draggable
        onStop={this.movePlayer}
        bounds="parent"
        position={{ x: coordX, y: coordY }}
        cancel=".character-cursor-other"
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
            {mjCheck
              && (
              <TiDelete
                className="character-nickname-delete"
                onClick={deletePlayer}
              />
              )}
          </div>
          <div
            className={userClass}
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
