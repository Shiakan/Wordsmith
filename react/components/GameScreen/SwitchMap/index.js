/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import classNames from 'classnames';


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
    role: PropTypes.string.isRequired,
    boardAvailable: PropTypes.bool.isRequired,
  }

  componentDidMount() {
    console.log('switch map loaded');
  }

  render() {
    const {
      toggleScreen, toggleGrid, grid, role, boardAvailable,
    } = this.props;
    const classSwitch = classNames(
      'mapSwitch-button',
      {
        'mapSwitch-button--notAMj': role !== 'dm',
      },
    );
    return (
      <form className="mapSwitch">
        {boardAvailable
          ? (
            console.log('board true'),
              <button
                type="button"
                className={classSwitch}
                onClick={toggleScreen}
              >Switch to Board
              </button>
          )
          : (
            console.log('board false'),
              <button
                type="button"
                disabled={role !== 'dm'}
                className={classSwitch}
                onClick={toggleScreen}
              >Switch to Board
              </button>
          )
        }
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
          <span className="spanGrid">Quadrillage</span>
        </MuiThemeProvider>
      </form>
    );
  }
}

/**
 * Export
 */
export default SwitchMap;
