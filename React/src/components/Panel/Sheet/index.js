/**
 * Import
 */
import React from 'react';

/**
 * Local import
 */
// Composants

// Styles et assets
import './sheet.sass';

/**
 * Code
 */
const Sheet = () => (
  <div className="sheet">
    <p className="sheet-name">Votre Nom</p>
    <textarea
      // ROWS="3"
      // COLS="30"
      type="text"
      className="sheet-character"
      placeholder="feuille personnage"
    //   onChange={this.auteurChange}
    //   value={tempAuteur}
    //   focus="on"
    />
  </div>
);

/**
 * Export
 */
export default Sheet;
