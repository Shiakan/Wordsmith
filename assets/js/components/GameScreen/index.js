/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import classNames from 'classnames';
import { FaAngleDoubleRight, FaAngleDoubleLeft } from 'react-icons/fa';
/**
 * Local import
*/
// Composants
import Character from '../../containers/Character';
import SwitchMap from '../../containers/SwitchMap';
import SwitchMJ from '../../containers/SwitchMJ';
import Board from '../../containers/Board';


// Styles et assets
import './gamescreen.sass';

/**
 * Code
 */
class GameScreen extends React.Component {
  static propTypes = {
    toggleScreen: PropTypes.func.isRequired,
    isBoard: PropTypes.bool.isRequired,
    map: PropTypes.string.isRequired,
    isMap: PropTypes.bool.isRequired,
    grid: PropTypes.bool.isRequired,
    characters: PropTypes.arrayOf(PropTypes.object.isRequired).isRequired,
    handleSlide: PropTypes.func.isRequired,
    isSlided: PropTypes.bool.isRequired,
    role: PropTypes.string.isRequired,
    shareDrawing: PropTypes.func.isRequired,

  };

  componentDidMount() {
    console.log('gameScreen loaded');
  }

  shouldComponentUpdate = (nextProps, nextState) => {
    console.log('CSU CSU CSU', nextProps, nextState);
    return true;
  }

  render() {
    const {
      toggleScreen, isBoard, map, isMap,
      grid, characters, handleSlide, isSlided, role, shareDrawing,
    } = this.props;
    const classSwitch = classNames(
      'screen-switch',
      {
        'screen-switch--active': isSlided,
        'screen-switch--notAMj': role !== 'dm',
      },
    );
    const classArrow = classNames(
      'screen-switch-arrow',
      {
        'screen-switch-arrow--board': isBoard || role !== 'dm',
      },
    );
    return (
      <div className="screen">
        <div
          className={classSwitch}
        >

          {isMap
            && (
            <div className="screen-switch-form">
              <SwitchMap />
              {role === 'dm' && <SwitchMJ /> }
            </div>
            ) }
          {isBoard
            && (
            <div>
              <button
                type="button"
                className="screen-switch-button"
                onClick={toggleScreen}
              >
            Switch to Map
              </button>
              <button
                type="button"
                className="screen-switch-button"
                onClick={shareDrawing}
              >Share Board
              </button>
            </div>
            ) }
          {isSlided ? (
            <FaAngleDoubleLeft
              className={classArrow}
              onClick={handleSlide}
            />
          ) : (
            <FaAngleDoubleRight
              className={classArrow}
              onClick={handleSlide}
            />
          )}
        </div>
        {isMap && (
        <div className="screen-map">
          {characters.map(character => (
            <Character
              key={character.id}
              {...character}
            />
          ))}
          {grid && <div className="screen-map-grid" />}
          <img
            src={map}
            alt="map"
            className="screen-map-image"
          />

        </div>
        ) }
        {isBoard && <Board /> }
      </div>
    );
  }
}

/**
 * Export
 */
export default GameScreen;
