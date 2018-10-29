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
export const SHARE_DICE = 'SHARE_DICE';
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
        rolled: action.dice,
        diceCritic: action.critic,
      };

    case DICE_CHANGE:
      return {
        ...state,
        diceValue: action.value,
      };

    case SHARE_DICE:
      return {
        ...state,
        diceValue: '',
      };
    default:
      return state;
  }
};

/**
 * Action Creators
 */

export const rollDice = (dice, critic) => ({
  type: ROLL_DICE,
  dice,
  critic,
});

export const diceChange = value => ({
  type: DICE_CHANGE,
  value,
});

export const diceShare = () => ({
  type: SHARE_DICE,
});

/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
