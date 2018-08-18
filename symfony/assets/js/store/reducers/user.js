// import uuidv4 from 'uuid/v4'; // https://www.npmjs.com/package/uuid

/**
 * Initial State
 */
const initialState = {
  userName: 'temp',
  role: 'temptoo',
  charSheet: 'tempthree',
  roomId: 'tempfour',
};

/**
 * Types
 */
const DO_SOMETHING = 'DO_SOMETHING';

/**
 * Traitements
 */
// const numberOfSides = dice.slice(2);



/**
 * Reducer
 */
const reducer = (state = initialState, action = {}) => {
  switch (action.type) {
    case DO_SOMETHING:
      return {
        ...state,
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

/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
