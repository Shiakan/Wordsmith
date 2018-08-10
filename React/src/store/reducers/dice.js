/**
 * Initial State
 */
const initialState = {
  diceInput: '',
};

/**
 * Types
 */
const ROLL_DICE = 'ROLL_DICE';
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
        test: 'gg',
      };

    case DICE_CHANGE:
      return {
        ...state,
        diceInput: action.value,
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
