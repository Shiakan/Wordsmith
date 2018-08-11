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
      <form className="switch-map">
        <button
          type="button"
          className="switch-map-button"
          onClick={toggleScreen}
        >
              Switch to Board
        </button>
        <input
          type="checkbox"
          id="check"
          name="check"
          className="switch-map-checkbox"
          onChange={toggleGrid}
          checked={grid}
        />
        <label
          className="switch-map-label"
          htmlFor="check"
          id="box"
        >
              Quadrillage
        </label>
      </form>
    );
  }
}

/**
 * Export
 */
export default SwitchMap;
