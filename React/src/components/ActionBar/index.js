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
        <div className="actionBar-mj">MJ</div>
        <div className="actionBar-table">
          <button onClick={showDice} type="button" className="actionBar-table-dice">DICES</button>
          <button onClick={showSheet} type="button" className="actionBar-table-sheet">SHEET</button>
          <button onClick={showHelp} type="button" className="actionBar-table-help">HELP</button>
        </div>
        <div className="actionBar-player">
          <div className="actionBar-player-1">P1</div>
          <div className="actionBar-player-2">P2</div>
          <div className="actionBar-player-3">P3</div>
          <div className="actionBar-player-4">P4</div>
        </div>
      </div>
    )
  }

}

/**
 * Export
 */
export default ActionBar;
