/**
 * Import
 */
import React from 'react';

/**
 * Local import
 */
// Composants

// Styles et assets
import './dice.sass';

/**
 * Code
 */
const Dice = () => (
  <div className="dice">
    <p>DiceTEST</p>
    <div>
      <form
        className="dice-form"
        autoComplete="off"
        // onSubmit={this.auteurSubmit}
      >
        <input
          type="text"
          className="dice-form-input"
        //   onChange={this.auteurChange}
        //   value={tempAuteur}
        //   focus="on"
        />
        <button
          type="button"
          className="dice-form-roll"
          // onClick={}
        >
          Roll
        </button>
      </form>
      <p> Votre résultat est </p>
      <button
        type="button"
        className="dice-form-share"
        // onClick={}
      >
        MJ Share
      </button>
    </div>
  </div>
);

/**
 * Export
 */
export default Dice;
