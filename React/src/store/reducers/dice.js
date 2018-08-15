// import uuidv4 from 'uuid/v4'; // https://www.npmjs.com/package/uuid

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

/**
 * Reducer
 */
const reducer = (state = initialState, action = {}) => {
  switch (action.type) {
    case ROLL_DICE: {
      const rolled = roll(state.diceValue);
      // const newDice = {
      //   id: uuidv4(),
      //   // auteur: action.auteur,
      //   message: rolled,
      //   // userId: action.userId,
      // };
      return {
        ...state,
        rolled,
        // messages: [...state.messages.messages, newDice],
      }; }

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
