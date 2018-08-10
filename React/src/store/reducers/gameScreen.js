/**
 * Initial State
 */
const initialState = {
  board: false,
  map: true,
  // grid: true,
  // color: '#d4c4fb',
  // toggle: false,
  // moving: false,
  // created: false,
};

/**
 * Types
 */
const DO_SOMETHING = 'DO_SOMETHING';
const TOGGLE_SCREEN = 'TOGGLE_SCREEN';

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

    case TOGGLE_SCREEN:
      return {
        ...state,
        board: !state.board,
        map: !state.map,
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

export const toggleScreen = () => ({
  type: TOGGLE_SCREEN,
});

/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
