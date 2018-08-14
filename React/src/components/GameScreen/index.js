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
import Character from 'src/containers/Character';
import SwitchMap from 'src/containers/SwitchMap';
import SwitchMJ from 'src/containers/SwitchMJ';

// Styles et assets
import './gamescreen.sass';

/**
 * Code
 */
class GameScreen extends React.Component {
  static propTypes = {
    toggleScreen: PropTypes.func.isRequired,
    board: PropTypes.bool.isRequired,
    map: PropTypes.bool.isRequired,
    grid: PropTypes.bool.isRequired,
    characters: PropTypes.arrayOf(PropTypes.object.isRequired).isRequired,
    handleSlide: PropTypes.func.isRequired,
    isSlided: PropTypes.bool.isRequired,
  };

  componentDidMount() {
    console.log('gameScreen loaded');
  }

  render() {
    const {
      toggleScreen, board, map,
      grid, characters, handleSlide, isSlided,
    } = this.props;
    const classCss = classNames(
      'screen-switch',
      {
        'screen-switch--active': isSlided,
      },
    );
    return (
      <div className="screen">
        <div
          className={classCss}
        >

          {map
            && (
            <div className="screen-switch-form">
              <SwitchMap />
              <SwitchMJ />
            </div>
            ) }
          {board
            && (
            <button
              type="button"
              className="screen-switch-button"
              onClick={toggleScreen}
            >
            Switch to Map
            </button>
            ) }
          {isSlided ? (
            <FaAngleDoubleLeft
              className="screen-switch-arrow"
              onClick={handleSlide}
            />
          ) : (
            <FaAngleDoubleRight
              className="screen-switch-arrow"
              onClick={handleSlide}
            />
          )}
        </div>
        {map && (
        <div className="screen-map">
          {characters.map(character => (
            <Character
              key={character.id}
              {...character}
            />
          ))}
          {grid && <div className="screen-map-grid" />}
          <img
            src="http://medievalshop.com/parchemin/wp-content/uploads/2013/08/La-prison.jpg"
            alt="map"
            className="screen-map-image"
          />

        </div>
        ) }
        {board && <div className="screen-board">THIS IS THE BOARD</div> }
      </div>
    );
  }
}

/**
 * Export
 */
export default GameScreen;
