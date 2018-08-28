/**
 * Initial State
 */
const initialState = {
  // // J'initie mon chat vide
  // messages: [],
};

/**
 * Types
 */
const DO_SOMETHING = 'DO_SOMETHING';
// const SEND_MESSAGE = 'SEND_MESSAGE';


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

      // case SEND_MESSAGE: {
      //   // Je créer un objet dans lequel je range les data recues
      //   const newMessEntry = {
      //     id: action.id,
      //     auteur: action.auteur,
      //     message: action.message,
      //     userId: action.userId,
      //   };
      //   // Nouveau state
      //   return {
      //     ...state,
      //     // Je le rajoute au state existant
      //     messages: [...state.messages, newMessEntry],
      //   };
      // }

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

// export const sheetChange = value => ({
//   type: SHEET_CHANGE,
//   value,
// });


/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
