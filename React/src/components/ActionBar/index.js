/**
 * Import
 */
import React from 'react';

/**
 * Local import
 */
// Composants

// Styles et assets
import './actionbar.sass';

/**
 * Code
 */
const ActionBar = () => (
  <div className="actionBar">
    <div className="actionBar-mj">MJ</div>
    <div className="actionBar-table">
      <button type="button" className="actionBar-table-dice">DICES</button>
      <button type="button" className="actionBar-table-sheet">SHEET</button>
      <button type="button" className="actionBar-table-help">HELP</button>
    </div>
    <div className="actionBar-player">
      <div className="actionBar-player-1">P1</div>
      <div className="actionBar-player-2">P2</div>
      <div className="actionBar-player-3">P3</div>
      <div className="actionBar-player-4">P4</div>
    </div>
  </div>
);

/**
 * Export
 */
export default ActionBar;
