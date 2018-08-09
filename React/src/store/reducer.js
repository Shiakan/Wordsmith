/**
 * Initial State
 */
const initialState = {
  dice: true,
  sheet: false,
  help: false,
};

/**
 * Types
 */
const DO_SOMETHING = 'DO_SOMETHING';
const SHOW_DICE = 'SHOW_DICE';
const SHOW_SHEET = 'SHOW_SHEET';
const SHOW_HELP = 'SHOW_HELP';

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

    case SHOW_DICE:
      return {
        ...state,
        dice: true,
        sheet: false,
        help: false,
      };

    case SHOW_SHEET:
      return {
        ...state,
        dice: false,
        sheet: true,
        help: false,
      };

    case SHOW_HELP:
      return {
        ...state,
        dice: false,
        sheet: false,
        help: true,
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

export const showDice = () => ({
  type: SHOW_DICE,
});

export const showSheet = () => ({
  type: SHOW_SHEET,
});

export const showHelp = () => ({
  type: SHOW_HELP,
});

/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
