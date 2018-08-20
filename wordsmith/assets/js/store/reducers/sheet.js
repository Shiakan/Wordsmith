/**
 * Initial State
 */

const initialState = {
  charSheet: 'Veuillez patienter',
};

/**
 * Types
 */
const DO_SOMETHING = 'DO_SOMETHING';
const SHEET_CHANGE = 'SHEET_CHANGE';


/**
 * Traitements
 */

/**
 * Reducer
 */
const reducer = (state = initialState, action = {}) => {
  switch (action.type) {
    case DO_SOMETHING:
      return {
        ...state,
      };

    case SHEET_CHANGE:
      return {
        ...state,
        charSheet: action.value,
      };

    default:
      return state;
  }
};

/**
 * Action Creators
 */
export const doSomething = () => ({
  type: DO_SOMETHING,
});

export const sheetChange = value => ({
  type: SHEET_CHANGE,
  value,
});


/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
