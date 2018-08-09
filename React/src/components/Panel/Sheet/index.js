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
    <p>SheetTEST</p>
    <p>Votre Nom</p>
    <input
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
