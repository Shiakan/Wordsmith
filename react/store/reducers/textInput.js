import uuidv4 from 'uuid/v4'; // https://www.npmjs.com/package/uuid
import { ROLL_DICE } from './dice';
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
const MESSAGE_RECEIVED = 'MESSAGE_RECEIVED';

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
      // // Je créer un objet dans lequel je range les data recues
      // const newMessEntry = {
      //   id: uuidv4(),
      //   // auteur: action.auteur,
      //   message: state.message,
      //   // userId: action.userId,
      // };
      // Nouveau state
      return {
        ...state,
        // Je le rajoute au state existant
        // messages: [...state.messages, newMessEntry],
        message: '',
      };
    }

    // case ROLL_DICE: {
    // // Je créer un objet dans lequel je range les data recues
    //   const newDice = {
    //     id: uuidv4(),
    //     // auteur: action.auteur,
    //     message: action.dice,
    //   // userId: action.userId,
    //   };
    //   // Nouveau state
    //   return {
    //     ...state,
    //     // Je le rajoute au state existant
    //     messages: [...state.messages, newDice],
    //   };
    // }

    case MESSAGE_RECEIVED: {
      // Je créer un objet dans lequel je range les data recues
      const newMessEntry = {
        id: action.id,
        author: action.author,
        message: action.message,
        dice: action.dice,
        diceValue: action.diceValue,
        critic: action.critic,
      };
      // Nouveau state
      return {
        ...state,
        // Je le rajoute au state existant
        messages: [...state.messages, newMessEntry],
      };
    }
    // return {
    //   ...state,
    //   rolled: action.dice,
    // };

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

export const receiveMessage = message => ({
  type: MESSAGE_RECEIVED,
  message: message.message,
  id: message.id,
  author: message.author,
  dice: message.dice,
  diceValue: message.diceValue,
  critic: message.diceCritic,
});
/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
