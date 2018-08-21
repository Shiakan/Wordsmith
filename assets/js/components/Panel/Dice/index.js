/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import ReactTooltip from 'react-tooltip';
import { FaInfoCircle } from 'react-icons/fa/';
import classNames from 'classnames';

/**
 * Local import
 */
import dicePng from '../../../assets/img/dicesTest1.png';

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
      numberOfDices += 1;
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

  handleSubmit = (evt) => {
    evt.preventDefault();
    const { rollDice, diceValue } = this.props;
    const value = this.roll(diceValue);
    // console.log(rollDice);
    rollDice(value);
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
      'tooltip',
      {
        'tooltip-error': rolled === 'wrong',
      },
    );
    return (
      <div className="dice">
        <img
          className="dice-img"
          src={dicePng}
          alt="some roleplay dices"
        />
        <div className="dice-block">
          <form
            className="dice-block-form"
            autoComplete="off"
            onSubmit={this.handleSubmit}
          >
            <div className="roll-input-flex">
              <input
                type="text"
                className="dice-block-form-input"
                onChange={this.diceChange}
                placeholder="ex : 1d20"
                value={diceValue}
              />
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
                <p className="tooltip-text">
                Pour lancer un dé, il vous faut écrire sous cette forme xDy où :
                </p>
                <ul className="tooltip-ul">
                  <li className="tooltip-ul-li">x correspond au nombre de dés à lancer</li>
                  <li className="tooltip-ul-li">D est le séparateur</li>
                  <li className="tooltip-ul-li">y le nombre de face pour les dés à lancer</li>
                </ul>
                <p className="tooltip-text">
                Par exemple, la commande 2D100 revient à lancer deux dés à cent faces
                </p>
              </ReactTooltip>
            </div>
            <button
              type="submit"
              className="dice-block-form-roll"
              value="Roll"
            >
              Roll
            </button>
          </form>
          {/* if the rolled dices throws an error : */}
          {rolled === 'wrong'
          && <p className="dice-block-result"> Bravo, vous avez jeté les dés en dehors du plateau... </p>
          }
          {/* if there is a result and that this result isn't wrong */}
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
            MJ Share
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
