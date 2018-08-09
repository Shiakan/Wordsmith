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
    creating: false,
    created: false,
    playerOne: {
      coordX: '',
      coordY: '',
    },
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

  createPlayer = () => {
    console.log('Player created, click on the map to make it appear !');
    const { creating } = this.state;
    this.setState({
      creating: true,
    });
  }

  displayPlayer = (e) => {
    console.log('coords :', e.pageX, e.pageY);
    const { coordX, coordY } = this.state.playerOne;

    this.setState({
      playerOne: {
        coordX: e.pageX,
        coordY: e.pageY,
      },
      // creating: false,
      created: true,
    });
    console.log(this.state.playerOne);
  }

  render() {
    const {
      board,
      map,
      grid,
      color,
      toggle,
      creating,
      created,

    } = this.state;
    const { coordX, coordY } = this.state.playerOne;
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
          {grid && <div className="screen-map-grid" onClick={creating ? this.displayPlayer : undefined} />}
          <img
            src="http://medievalshop.com/parchemin/wp-content/uploads/2013/08/La-prison.jpg"
            alt="map"
            className="screen-map-image"
          />
          {created && (
          <div
            className="screen-map-player"
            style={{
              backgroundColor: color,
              position: 'absolute',
              left: `${coordX - 30}px`,
              top: `${coordY - 30}px`,
            }}

          />
          ) }
          <div className="screen-map-custom">
            {toggle
                && (
                <GithubPicker
                  class="screen-map-custom-picker"
                  color={color}
                  onChangeComplete={this.handleChangeComplete}
                  triangle="hide"
                />
                )}
            <form className="screen-map-custom-form">
              <button
                type="button"
                style={{ backgroundColor: color }}
                onClick={this.togglePicker}
              >
              &nbsp;
              </button>
              <input type="text" />
              <button
                type="button"
                onClick={this.createPlayer}
              >
              +
              </button>
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
