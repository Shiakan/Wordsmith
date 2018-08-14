import uuidv4 from 'uuid/v4'; // https://www.npmjs.com/package/uuid

/**
 * Initial State
 */
const initialState = {
  // La valeur de mon input form
  message: '',
  messages: [],
};

/**
 * Types
 */
const INPUT_CHANGE = 'INPUT_CHANGE';
export const ADD_MESSAGE = 'ADD_MESSAGE';


/**
 * Traitements
 */

/**
 * Reducer
 */
const reducer = (state = initialState, action = {}) => {
  switch (action.type) {
    // input controllé
    case INPUT_CHANGE:
      return {
        ...state,
        message: action.message,
      };

    case ADD_MESSAGE: {
      // Je créer un objet dans lequel je range les data recues
      const newMessEntry = {
        id: uuidv4(),
        // auteur: action.auteur,
        message: state.message,
        // userId: action.userId,
      };
      // Nouveau state
      return {
        ...state,
        // Je le rajoute au state existant
        messages: [...state.messages, newMessEntry],
        message: '',
      };
    }

    default:
      return state;
  }
};

/**
 * Action Creators
 */
export const changeInput = value => ({
  type: INPUT_CHANGE,
  message: value,
});

export const addMessage = () => ({
  type: ADD_MESSAGE,
});


/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
