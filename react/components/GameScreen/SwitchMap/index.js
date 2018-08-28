/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import Switch from '@material-ui/core/Switch';
import { MuiThemeProvider, createMuiTheme } from '@material-ui/core/styles';
/**
 * Local import
 */
// Composants

// Styles et assets
import './switchmap.sass';

/**
 * Code
 */
const theme = createMuiTheme({
  palette: {
    primary: { main: '#3f7a5d' },
  },
});

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
        {/* <label
          className="mapSwitch-label"
          htmlFor="check"
          id="box"
        > */}
        <MuiThemeProvider theme={theme}>
          <Switch
            type="checkbox"
            id="check"
            name="check"
            color="primary"
            className="mapSwitch-checkbox"
            onChange={toggleGrid}
            checked={grid}
          />
          <span>Quadrillage</span>
        </MuiThemeProvider>
        {/* </label> */}
      </form>
    );
  }
}

/**
 * Export
 */
export default SwitchMap;
