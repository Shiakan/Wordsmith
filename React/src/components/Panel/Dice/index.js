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
    diceChange: PropTypes.func.isRequired,
    diceValue: PropTypes.string,
    rollResult: PropTypes.number,
  }

  static defaultProps = {
    diceValue: '',
    rollResult: '',
  }

  componentDidMount() {
    console.log('Dice cDM');
  }

  handleSubmit = (evt) => {
    evt.preventDefault();
    const { rollDice } = this.props;
    // console.log(rollDice);
    rollDice();
  }

  diceChange = (evt) => {
    const { diceChange } = this.props;
    // Je recup la valeur du champ
    const { value } = evt.target;
    console.log(value);
    // passer la valeur vers le state => disptach avec une action capable de prendre cette valeur
    diceChange(value);
  }

  render() {
    const {
      diceValue,
      rollResult,
    } = this.props;
    return (
      <div className="dice">
        <p className="dice-text">DiceTEST</p>
        <div
          className="dice-img"
          src="src/assets/img/dicesTest1.png"
          alt="some roleplay dices"
        />
        <div className="dice-block">
          <form
            className="dice-block-form"
            autoComplete="off"
            onSubmit={this.handleSubmit}
          >
            <input
              type="text"
              className="dice-block-form-input"
              onChange={this.diceChange}
              placeholder="ex : 1d20"
              value={diceValue}
            />
            <button
              type="submit"
              className="dice-block-form-roll"
              // onClick={this.handleSumbit}
              value="Roll"
            >
              Roll
            </button>
          </form>
          <p className="dice-block-result"> Votre résultat est : {rollResult} </p>
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
