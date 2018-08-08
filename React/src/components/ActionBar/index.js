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
      <button type="button" className="actionBar-table-dice">DICE</button>
      <button type="button" className="actionBar-table-sheet">FICHE</button>
      <button type="button" className="actionBar-table-help">HELP</button>
    </div>
    <div className="actionBar-player1">P1</div>
    <div className="actionBar-player2">P2</div>
    <div className="actionBar-player3">P3</div>
    <div className="actionBar-player4">P4</div>
  </div>
);

/**
 * Export
 */
export default ActionBar;
