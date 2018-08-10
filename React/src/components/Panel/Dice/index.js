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
import './dice.sass';
/**
 * Code
 */
class Dice extends React.Component {
  static propTypes = {
    rollDice: PropTypes.func.isRequired,
  }
  
  componentDidMount() {
    console.log('Dice cDM');
  }

  handleSubmit = (evt) => {
    evt.preventDefault();
    const { rollDice } = this.props;
    console.log('ok');
    rollDice();
  }

  render() {
    // const {
    //   rollDice,
    // } = this.props;
    return (
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
            onSubmit={this.handleSubmit}
          >
            <input
              type="text"
              className="dice-form-input"
            //   onChange={this.auteurChange}
            //   value={tempAuteur}
            //   focus="on"
            />
            <input
              type="submit"
              className="dice-form-roll"
              // onClick={this.handleSumbit}
              value="Roll"
            />
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
  }
}

/**
 * Export
 */
export default Dice;
