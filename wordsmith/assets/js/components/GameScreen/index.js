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
    const classSwitch = classNames(
      'screen-switch',
      {
        'screen-switch--active': isSlided,
      },
    );
    const classArrow = classNames(
      'screen-switch-arrow',
      {
        'screen-switch-arrow--board': board,
      },
    );
    return (
      <div className="screen">
        <div
          className={classSwitch}
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
            src="http://4.bp.blogspot.com/-YCn-yY_Wt-c/UtME0OoI_FI/AAAAAAAADOY/1IeqF92KSLU/s800/DungeonZ+-+The+city+-+Overlays-+The+Prancing+Dragon+Tavern.jpg"
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
