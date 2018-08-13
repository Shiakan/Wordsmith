import { empty } from "rxjs/observable/empty";

/**
 * Initial State
 */
const initialState = {
  diceValue: '',
  rolled: 0,
};

/**
 * Types
 */
const ROLL_DICE = 'ROLL_DICE';
const DICE_CHANGE = 'DICE_CHANGE';

/**
 * Traitements
 */
// const numberOfSides = dice.slice(2);

const roll = (dice) => {
  const numberOfDices = dice.split(/d|D/)[0];
  const numberOfSides = dice.split(/d|D/)[1];
  let total = 0;
  console.log(numberOfDices);
  console.log(numberOfSides);
  if (typeof (numberOfSides) !== 'undefined' && (numberOfSides && numberOfDices > '0') && !Number.isNaN(Number(total))) {
    for (let dices = 0; dices < numberOfDices; dices += 1) {
      total += Math.floor(Math.random() * numberOfSides) + 1;
      // console.log(total);
    }
    // console.log(total);
    return total;
  }

  return 777;
};

// if (typeof (numberOfSides) !== 'undefined' && (numberOfSides && numberOfDices > '0') && !Number.isNaN(total)) {

/**
 * Reducer
 */
const reducer = (state = initialState, action = {}) => {
  switch (action.type) {
    case ROLL_DICE:
      return {
        ...state,
        rolled: roll(state.diceValue),
      };

    case DICE_CHANGE:
      return {
        ...state,
        diceValue: action.value,
      };
    default:
      return state;
  }
};

/**
 * Action Creators
 */

export const rollDice = () => ({
  type: ROLL_DICE,
});

export const diceChange = value => ({
  type: DICE_CHANGE,
  value,
});

/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
