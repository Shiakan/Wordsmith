/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import ReactTooltip from 'react-tooltip';
import { FaInfoCircle } from 'react-icons/fa/';
import classNames from 'classnames';
import TextField from '@material-ui/core/TextField';
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
    diceShare: PropTypes.func.isRequired,
    diceChange: PropTypes.func.isRequired,
    role: PropTypes.string,
    diceValue: PropTypes.string,
    rolled: PropTypes.oneOfType([
      PropTypes.string,
      PropTypes.number,
    ]),
  }

  static defaultProps = {
    diceValue: '',
    rolled: '',
    role: '',
  }

  componentDidMount() {
    const { role } = this.props;
    console.log('Dice cDM', role);
  }

  roll = (dice) => {
    // I want the player to enter his dice throw this way :
    // xDy
    // x is the number of dices
    // D stands for dice, I'm using it to split my incoming string
    // y is the number of sides for one dice
    // So that 1d20 (or 1D20 thanx to regEx) means you want to throw one dice with 20 faces

    // Before d(or D), you'll find the number of dices
    let numberOfDices = dice.split(/d|D/)[0];
    // After d(or D), you'll find the number of sides for a dice
    const numberOfSides = dice.split(/d|D/)[1];
    let total = 0;
    // if the user didn't type any numberOfDices
    // I assume that he wanted to throw only one dice
    // so typing d20 is like typing 1d20
    if (numberOfDices < 1) {
      numberOfDices = 1;
    }
    // I need to verify that numberOfDices & numberOfSides are numbers
    // and that numberOfSiders is greater than zero (a dice has at least 1 face (sphere))
    if (Number.parseFloat(numberOfDices) && Number.parseFloat(numberOfSides) && numberOfSides > '0') {
      // Then for each Dice I add a random number from 1 to numberOfSides
      for (let dices = 0; dices < numberOfDices; dices += 1) {
        total += Math.floor(Math.random() * numberOfSides) + 1;
      }
      return total;
    }
    // If my previous test (if) has failed :
    return 'wrong';
  };

  critic = (rollValue, diceValue) => {
    // Before d(or D), you'll find the number of dices
    const numberOfDices = diceValue.split(/d|D/)[0];
    // After d(or D), you'll find the number of sides for a dice
    const numberOfSides = Number(diceValue.split(/d|D/)[1]);
    console.log('NUMBER OF SIDES', numberOfSides);
    if (numberOfSides === 20 || numberOfSides === 100) {
      console.log('SIDES FILTERED', numberOfSides);
      if (numberOfDices > 1) {
        return 'no';
      }
      // numberOfDices = 1;
      const maxPossible = numberOfDices * numberOfSides;
      const success = Math.floor(maxPossible * (5 / 100));
      // if (success < 1) {
      //   success = 1;
      // }
      const failed = Math.floor(maxPossible - (maxPossible * (5 / 100)));
      if (rollValue <= success) {
        return 'success';
      }
      if (rollValue > failed) {
        return 'failed';
      }
    }
    return 'no';
  }

  handleSubmit = (evt) => {
    evt.preventDefault();
    const { rollDice, diceValue } = this.props;
    const rollValue = this.roll(diceValue);
    const critic = this.critic(rollValue, diceValue);
    console.log(critic, 'CRITIC FUNC');
    // console.log(rollDice);
    rollDice(rollValue, critic);
  }

  diceChange = (evt) => {
    const { diceChange } = this.props;
    // I get the field value
    const { value } = evt.target;
    // I dispatch a field value with an action
    diceChange(value);
  }

  shareRoll = () => {
    const { diceShare } = this.props;
    diceShare();
  }

  render() {
    const {
      diceValue,
      rolled,
      role,
    } = this.props;
    const toolTip = classNames(
      'dice-block-tooltip',
      {
        'dice-block-tooltip-error': rolled === 'wrong',
      },
    );
    return (
      <div className="dice">
        <img
          className="dice-img"
          src="https://nsa39.casimages.com/img/2018/08/28//180828112248528392.png"
          alt="some roleplay dices"
        />
        <div className="dice-block">
          <form
            className="dice-block-form"
            autoComplete="off"
            onSubmit={this.handleSubmit}
          >
            <FaInfoCircle
              className={toolTip}
              data-tip="React-tooltip"
            />
            <ReactTooltip
              place="left"
              type="dark"
              effect="float"
              border
            >
              <p className="dice-block-tooltip-text">
                Pour lancer un dé, il vous faut écrire sous cette forme xDy où :
              </p>
              <ul className="dice-block-tooltip-ul">
                <li className="dice-block-tooltip-ul-li">x correspond au nombre de dés à lancer</li>
                <li className="dice-block-tooltip-ul-li">D est le séparateur</li>
                <li className="dice-block-tooltip-ul-li">y le nombre de face pour les dés à lancer</li>
              </ul>
              <p className="dice-block-tooltip-text">
                Par exemple, la commande 2D100 revient à lancer deux dés à cent faces
              </p>
            </ReactTooltip>
            <TextField
              label="Jeter les dés"
              placeholder="ex : 1d20"
              onChange={this.diceChange}
              value={diceValue}
              className="dice-block-input"
            />
            <button
              type="submit"
              className="dice-block-roll"
              value="Roll"
            >
              Roll
            </button>
          </form>
          {/* if the rolled dices throws an error : */}
          {rolled === 'wrong'
          && <p className="dice-block-result">Dans votre empressement vous jetez les dés en dehors du plateau... </p>
          }
          {/* if there is a result and this result isn't wrong */}
          {rolled && rolled !== 'wrong'
          && <p className="dice-block-result">Vous avez tiré un {rolled}</p>
          }
          {role === 'dm'
          && (
          <button
            type="button"
            className="dice-block-share"
            onClick={this.shareRoll}
          >
            Partager
          </button>)
          }

        </div>
      </div>

    );
  }
}

/**
 * Export
 */
export default Dice;
