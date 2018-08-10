/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import { GithubPicker } from 'react-color';
/**
 * Local import
 */
// Composants

// Styles et assets
import './gamescreen.sass';

/**
 * Code
 */
class GameScreen extends React.Component {
  static propTypes = {
    togglePicker: PropTypes.func.isRequired,
    toggleScreen: PropTypes.func.isRequired,
    toggleGrid: PropTypes.func.isRequired,
    onChangeColor: PropTypes.func.isRequired,
    onInputChange: PropTypes.func.isRequired,
    onSubmitName: PropTypes.func.isRequired,
    onDisplayPlayer: PropTypes.func.isRequired,
    createPlayer: PropTypes.func.isRequired,
    board: PropTypes.bool.isRequired,
    map: PropTypes.bool.isRequired,
    grid: PropTypes.bool.isRequired,
    color: PropTypes.string.isRequired,
    toggle: PropTypes.bool.isRequired,
    moving: PropTypes.bool.isRequired,
    name: PropTypes.string.isRequired,
    created: PropTypes.bool.isRequired,
    typingName: PropTypes.string.isRequired,
    coordX: PropTypes.number.isRequired,
    coordY: PropTypes.number.isRequired,
  };

  componentDidMount() {
    console.log('gameScreen loaded');
  }

  handleChange = (e) => {
    const { onInputChange } = this.props;
    const { value } = e.target;
    onInputChange(value);
  }

  handleSubmit = (e) => {
    e.preventDefault();
    const { onSubmitName } = this.props;
    onSubmitName();
  }

  changeColor = (color) => {
    const { onChangeColor, togglePicker } = this.props;
    onChangeColor(color.hex);
    togglePicker();
  }

  displayPlayer = (e) => {
    const { onDisplayPlayer } = this.props;
    onDisplayPlayer(e);
  }

  render() {
    const {
      toggleScreen, toggleGrid, togglePicker, createPlayer, board, map,
      grid, color, toggle, moving, created, typingName, coordX, coordY, name,
    } = this.props;
    return (
      <div className="screen">
        <div className="screen-switch">
          {map
            && (
            <div>
              <form className="screen-switch-map">
                <button
                  type="button"
                  className="screen-switch-map-button"
                  onClick={toggleScreen}
                >
              Switch to Board
                </button>
                <input
                  type="checkbox"
                  id="check"
                  className="screen-switch-map-checkbox"
                  onChange={toggleGrid}
                  checked={grid}
                />
                <label
                  className="screen-switch-map-label"
                  htmlFor="check"
                >
              Quadrillage
                </label>
              </form>
              <div className="screen-switch-map-custom">
                {toggle
                && (
                <GithubPicker
                  class="screen-switch-map-custom-picker"
                  color={color}
                  width="170px"
                  onChange={this.changeColor}
                  triangle="hide"
                />
                )}
                <form className="screen-switch-map-custom-form" onSubmit={this.handleSubmit}>
                  <button
                    type="button"
                    style={{ backgroundColor: color }}
                    onClick={togglePicker}
                  >
                  &nbsp;
                  </button>
                  <input
                    className="screen-switch-map-custom-form-input"
                    type="text"
                    placeholder="Nom du personnage"
                    onChange={this.handleChange}
                    value={typingName}
                  />
                  <input
                    type="submit"
                    onClick={createPlayer}
                    value="+"
                  />

                </form>
              </div>
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
          <div
            className="screen-map-player"
            style={{
              position: 'absolute',
              left: `${coordX - 25}px`,
              top: `${coordY - 50}px`,
            }}
          >
            <span
              className="screen-map-player-nickname"
              style={{
                color,
              }}
            >{name}
            </span>
            <div
              className="screen-map-player-cursor"
              style={{
                backgroundColor: color,
              }}
            />
          </div>
          ) }

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
