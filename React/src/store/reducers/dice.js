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
const roll = (dice) => {
  let numberOfDice = dice[0];
  const numberOfSides = dice.slice(2);
  let total = 0;
  console.log(numberOfSides);
  for (numberOfDice; numberOfDice > 0; numberOfDice--) {
    total += Math.floor(Math.random() * numberOfSides) + 1;
  }
  console.log(total);
  return total;
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
