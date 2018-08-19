// import uuidv4 from 'uuid/v4'; // https://www.npmjs.com/package/uuid

/**
 * Initial State
 */
const initialState = {
  diceValue: '',
  rolled: '',
  rollHistory: [],
};

/**
 * Types
 */
export const ROLL_DICE = 'ROLL_DICE';
const DICE_CHANGE = 'DICE_CHANGE';

/**
 * Traitements
 */

/**
 * Reducer
 */
const reducer = (state = initialState, action = {}) => {
  switch (action.type) {
    case ROLL_DICE:
      return {
        ...state,
        // rolled: action.dice,
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

export const rollDice = dice => ({
  type: ROLL_DICE,
  dice,
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
