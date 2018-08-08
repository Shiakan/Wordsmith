/**
 * Import
 */
import React from 'react';

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
  }

  componentDidMount() {
    console.log('gameScreen loaded');
  }

  handleChange = () => {
    const { grid } = this.state;
    console.log('checked');

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

  render() {
    const { board, map, grid } = this.state;
    return (
      <div className="screen">
        <div className="screen-switch">
          {map
            && (
            <form className="screen-switch-map">
              <button
                type="button"
                className="screen-switch-button"
                onClick={this.handleClick}
              >
              Switch to Board
              </button>
              <input
                type="checkbox"
                name="check"
                className="screen-switch-checkbox"
                defaultChecked
                onChange={this.handleChange}
              />
              <p>Grid</p>
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
