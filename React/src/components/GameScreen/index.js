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
  }

  componentDidMount() {
    console.log('gameScreen loaded');
  }

  render() {
    const { board, map } = this.state;
    return (
      <div className="screen">
        <div className="screen-switch">
          {map && <button type="button" className="screen-switch-button">Switch to Board</button> }
          {board && <button type="button" className="screen-switch-button">Switch to Map</button> }
        </div>
      </div>
    );
  }
}

/**
 * Export
 */
export default GameScreen;
