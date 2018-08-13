/**
 * Initial State
 */
const initialState = {
  diceValue: '',
  rolled: '',
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
  // we assume that he wanted to throw only one dice
  // so typing d20 is like typing 1d20
  if (numberOfDices < 1) {
    numberOfDices += 1;
  }

  console.log('number of dices', numberOfDices);
  console.log('number of sides', numberOfSides);
  if (typeof (numberOfSides) !== 'undefined' && numberOfSides > '0' && !Number.isNaN(parseFloat(total))) {
    for (let dices = 0; dices < numberOfDices; dices += 1) {
      total += Math.floor(Math.random() * numberOfSides) + 1;
      // console.log(total);
    }
    // console.log(total);
    return total;
  }

  return 'wrong';
};

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
