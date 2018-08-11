/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
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
    onDisplayPlayer: PropTypes.func.isRequired,
    board: PropTypes.bool.isRequired,
    map: PropTypes.bool.isRequired,
    grid: PropTypes.bool.isRequired,
    moving: PropTypes.bool.isRequired,
    created: PropTypes.bool.isRequired,
  };

  componentDidMount() {
    console.log('gameScreen loaded');
  }

  displayPlayer = (e) => {
    const { onDisplayPlayer } = this.props;
    onDisplayPlayer(e);
  }

  render() {
    const {
      toggleScreen, board, map,
      grid, moving, created,
    } = this.props;
    return (
      <div className="screen">
        <div className="screen-switch">
          {map
            && (
            <div>
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
        </div>
        {map && (
        <div className="screen-map" onClick={moving ? this.displayPlayer : undefined}>
          {grid && <div className="screen-map-grid" onClick={moving ? this.displayPlayer : undefined} />}
          <img
            src="http://medievalshop.com/parchemin/wp-content/uploads/2013/08/La-prison.jpg"
            alt="map"
            className="screen-map-image"
          />
          {created && (
            <Character />
          )}
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
