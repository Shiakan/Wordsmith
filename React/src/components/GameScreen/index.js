/**
 * Import
 */
import React from 'react';
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
  state = {
    board: false,
    map: true,
    grid: true,
    color: '#b80000',
    toggle: false,
  }

  componentDidMount() {
    console.log('gameScreen loaded');
  }

  handleChange = () => {
    const { grid } = this.state;

    this.setState({
      grid: !grid,
    });
  }

  handleClick = () => {
    const { board, map } = this.state;
    console.log(this.state);

    this.setState({
      board: !board,
      map: !map,
    });
  }

  handleChangeComplete = (color) => {
    this.setState({ color: color.hex });
    console.log(this.state);
    this.togglePicker();
  };

  togglePicker = () => {
    const { toggle } = this.state;

    this.setState({
      toggle: !toggle,
    });
  }

  render() {
    const {
      board,
      map,
      grid,
      color,
      toggle,
    } = this.state;
    return (
      <div className="screen">
        <div className="screen-switch">
          {map
            && (
            <form className="screen-switch-map">
              <button
                type="button"
                className="screen-switch-map-button"
                onClick={this.handleClick}
              >
              Switch to Board
              </button>
              <input
                type="checkbox"
                id="check"
                className="screen-switch-map-checkbox"
                onChange={this.handleChange}
                checked={grid}
              />
              <label
                className="screen-switch-map-label"
                htmlFor="check"
              >
              Grid
              </label>
            </form>
            ) }
          {board
            && (
            <button
              type="button"
              className="screen-switch-button"
              onClick={this.handleClick}
            >
            Switch to Map
            </button>
            ) }
        </div>
        {map && (
        <div className="screen-map">
          {grid && <div className="screen-map-grid" />}
          <img
            src="http://medievalshop.com/parchemin/wp-content/uploads/2013/08/La-prison.jpg"
            alt="map"
            className="screen-map-image"
          />
          <div className="screen-map-custom">
            <form className="screen-map-custom-form">
              <button
                type="button"
                style={{ backgroundColor: color }}
                onClick={this.togglePicker}
              >
              &nbsp;
              </button>
              {toggle
                && (
                <GithubPicker
                  color={color}
                  onChangeComplete={this.handleChangeComplete}
                />
                )}
            </form>
          </div>
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
