import uuidv4 from 'uuid/v4'; // https://www.npmjs.com/package/uuid

/**
 * Initial State
 */
const initialState = {
  board: false,
  map: true,
  grid: true,
  color: '#d4c4fb',
  toggle: false,
  name: '',
  typingName: '',
  // coordX: 0,
  // coordY: 0,
  characters: [
    {
      id: uuidv4(),
      name: 'troll',
      color: '#b80000',
      coordX: 125,
      coordY: 250,
    },
    {
      id: uuidv4(),
      name: 'orc',
      color: '#008b02',
      coordX: 0,
      coordY: 0,
    },
    {
      id: uuidv4(),
      name: 'ben',
      color: '#fccb00',
      coordX: 0,
      coordY: 0,
    },
  ],
};
console.log(initialState.characters);

/**
 * Types
 */
const TOGGLE_SCREEN = 'TOGGLE_SCREEN';
const TOGGLE_GRID = 'TOGGLE_GRID';
const TOGGLE_PICKER = 'TOGGLE_PICKER';
const CHANGE_COLOR = 'CHANGE_COLOR';
const CREATE_PLAYER = 'CREATE_PLAYER';
const INPUT_CHANGE = 'INPUT_CHANGE';
const MOVE_PLAYER = 'MOVE_PLAYER';
const DELETE_PLAYER = 'DELETE_PLAYER';

/**
 * Traitements
 */
// const charsProp = (chars, id, lastProp, prop) => chars.map((char) => {
//   console.log(char);
//   if (char.id === id) {
//     return {
//       ...char,
//       [lastProp]: char[prop],
//     };
//   }
//   return char;
// });

/**
 * Reducer
 */
const reducer = (state = initialState, action = {}) => {
  switch (action.type) {
    case TOGGLE_SCREEN:
      return {
        ...state,
        board: !state.board,
        map: !state.map,
      };

    case TOGGLE_GRID:
      return {
        ...state,
        grid: !state.grid,
      };

    case TOGGLE_PICKER:
      return {
        ...state,
        toggle: !state.toggle,
      };

    case CHANGE_COLOR:
      return {
        ...state,
        color: action.value,
      };

    case CREATE_PLAYER: {
      console.log(state);
      const newChar = {
        id: uuidv4(),
        name: state.typingName,
        color: state.color,
        coordX: 0,
        coordY: 0,
      };

      return {
        ...state,
        characters: [...state.characters, newChar],
        typingName: '',
      };
    }

    case INPUT_CHANGE:
      return {
        ...state,
        typingName: action.value,
      };

    case MOVE_PLAYER: {
      const movedChars = state.characters.map((char) => {
        if (char.id === action.value.target.id) {
          console.log('old coords :', char.coordX, char.coordY);
          console.log('new coords :', action.value.pageX, action.value.pageY);
          char.coordX = action.value.pageX;
          char.coordY = action.value.pageY;
        }
        return char;
      });
      return {
        ...state,
        characters: movedChars,
      };
    }
    case DELETE_PLAYER: {
      const remainingChars = state.characters.filter(char => char.id !== action.id);

      return {
        ...state,
        characters: remainingChars,
      };
    }
    default:
      return state;
  }
};

/**
 * Action Creators
 */

export const toggleScreen = () => ({
  type: TOGGLE_SCREEN,
});

export const toggleGrid = () => ({
  type: TOGGLE_GRID,
});

export const togglePicker = () => ({
  type: TOGGLE_PICKER,
});

export const changeColor = value => ({
  type: CHANGE_COLOR,
  value,
});

export const changeInput = value => ({
  type: INPUT_CHANGE,
  value,
});

export const createPlayer = () => ({
  type: CREATE_PLAYER,
});

export const movePlayer = value => ({
  type: MOVE_PLAYER,
  value,
});

export const deletePlayer = id => ({
  type: DELETE_PLAYER,
  id,
});
/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
