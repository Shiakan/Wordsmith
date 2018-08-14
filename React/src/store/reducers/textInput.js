/**
 * Initial State
 */
const initialState = {
  // La valeur de mon input form
  message: '',
};

/**
 * Types
 */
const INPUT_CHANGE = 'INPUT_CHANGE';
export const MESSAGE_ADD = 'MESSAGE_ADD';


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

    case MESSAGE_ADD: {
      // Quand j'ai envoyé un message, je vide l'input controllé
      return {
        ...state,
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
  type: MESSAGE_ADD,
});


/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
