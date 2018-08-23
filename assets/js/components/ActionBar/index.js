/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import { FaChessPawn, FaUserTie } from 'react-icons/fa/';
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
          <button onClick={showDice} type="button" className="actionBar-table-dice">DÉS</button>
          <button onClick={showSheet} type="button" className="actionBar-table-sheet">FICHE</button>
          <button onClick={showHelp} type="button" className="actionBar-table-help">HELP</button>
        </div>
        <div className="actionBar-player">
          <FaChessPawn className="actionBar-player-1" />
          <FaChessPawn className="actionBar-player-2" />
          <FaChessPawn className="actionBar-player-3" />
          <FaChessPawn className="actionBar-player-4" />
        </div>
      </div>
    );
  }
}

/**
 * Export
 */
export default ActionBar;
