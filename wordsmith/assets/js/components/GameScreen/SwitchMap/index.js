/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';

/**
 * Local import
 */
// Composants

// Styles et assets
import './switchmap.sass';

/**
 * Code
 */
class SwitchMap extends React.Component {
  static propTypes = {
    toggleScreen: PropTypes.func.isRequired,
    toggleGrid: PropTypes.func.isRequired,
    grid: PropTypes.bool.isRequired,
  }

  componentDidMount() {
    console.log('switch map loaded');
  }

  render() {
    const { toggleScreen, toggleGrid, grid } = this.props;
    return (
      <form className="mapSwitch">
        <button
          type="button"
          className="mapSwitch-button"
          onClick={toggleScreen}
        >
        Switch to Board
        </button>
        <label
          className="mapSwitch-label"
          htmlFor="check"
          id="box"
        >
          <input
            type="checkbox"
            id="check"
            name="check"
            className="mapSwitch-checkbox"
            onChange={toggleGrid}
            checked={grid}
          />
          <span>Quadrillage</span>
        </label>
      </form>
    );
  }
}

/**
 * Export
 */
export default SwitchMap;
