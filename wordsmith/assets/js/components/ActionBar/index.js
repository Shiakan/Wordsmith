/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import { FaUserAlt, FaUserTie } from 'react-icons/fa/';

/**
 * Local import
 */
// Composants

// Styles et assets
import './actionbar.sass';

/**
 * Code
 */
class ActionBar extends React.Component {
  static propTypes = {
    showDice: PropTypes.func.isRequired,
    showSheet: PropTypes.func.isRequired,
    showHelp: PropTypes.func.isRequired,
  };

  componentDidMount() {
    console.log('ActionBar loaded');
  }

  render() {
    const {
      showDice,
      showSheet,
      showHelp,
    } = this.props;
    return (
      <div className="actionBar">
        <FaUserTie className="actionBar-mj" />
        <div className="actionBar-table">
          <button onClick={showDice} type="button" className="actionBar-table-dice">DICES</button>
          <button onClick={showSheet} type="button" className="actionBar-table-sheet">SHEET</button>
          <button onClick={showHelp} type="button" className="actionBar-table-help">HELP</button>
        </div>
        <div className="actionBar-player">
          <FaUserAlt className="actionBar-player-1" />
          <FaUserAlt className="actionBar-player-2" />
          <FaUserAlt className="actionBar-player-3" />
          <FaUserAlt className="actionBar-player-4" />
          {/* <img className="actionBar-player-1" src="src/assets/img/player.png" alt="player" /> */}
          {/* <div className="actionBar-player-1">P1</div>
          <div className="actionBar-player-2">P2</div>
          <div className="actionBar-player-3">P3</div>
          <div className="actionBar-player-4">P4</div> */}
        </div>
      </div>
    )
  }

}

/**
 * Export
 */
export default ActionBar;
