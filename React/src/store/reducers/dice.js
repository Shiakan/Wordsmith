/**
 * Initial State
 */
const initialState = {
  test: 'test',
};

/**
 * Types
 */
const ROLL_DICE = 'ROLL_DICE';

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

/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
