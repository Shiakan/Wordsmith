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
    <p className="dice-text">DiceTEST</p>
    <img
      className="dice-img"
      src="src/assets/img/dicesTest1.png"
      alt="some roleplay dices"
    />
    <div className="dice-block">
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
      <p className="dice-block-result"> Votre résultat est :</p>
      <button
        type="button"
        className="dice-block-share"
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
