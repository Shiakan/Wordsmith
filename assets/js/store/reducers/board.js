import uuidv4 from 'uuid/v4'; // https://www.npmjs.com/package/uuid
/**
 * Initial State
 */
const initialState = {
  drawColor: 'black',
  drawing: false,
};

/**
 * Types
 */
const START_DRAW = 'START_DRAW';
const STOP_DRAW = 'STOP_DRAW';


/**
 * Traitements
 */

/**
 * Reducer
 */
const reducer = (state = initialState, action = {}) => {
  switch (action.type) {
    // input controllé
    case START_DRAW:
      return {
        ...state,
        drawing: true,
      };
    case STOP_DRAW:
      return {
        ...state,
        drawing: false,
      };
    default:
      return state;
  }
};

/**
 * Action Creators
 */
export const startDrawing = () => ({
  type: START_DRAW,
});

export const stopDrawing = () => ({
  type: STOP_DRAW,
});
/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
