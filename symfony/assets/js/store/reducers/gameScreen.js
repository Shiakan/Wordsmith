import uuidv4 from 'uuid/v4'; // https://www.npmjs.com/package/uuid

/**
 * Initial State
 */
const initialState = {
  board: false,
  map: true,
  grid: true,
  color: '#f44336',
  toggle: false,
  isSlided: false,
  cpt: 1,
  cptX: 70,
  cptY: 170,
  name: '',
  typingName: '',
  characters: [
    {
      id: uuidv4(),
      name: 'troll',
      color: '#b80000',
      coordX: 10,
      coordY: 170,
    },
    {
      id: uuidv4(),
      name: 'orc',
      color: '#008b02',
      coordX: 10,
      coordY: 240,
    },
    {
      id: uuidv4(),
      name: 'ben',
      color: '#fccb00',
      coordX: 10,
      coordY: 310,
    },
    {
      id: uuidv4(),
      name: 'nain',
      color: '#b80000',
      coordX: 10,
      coordY: 380,
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
const INPUT_CHAR_CHANGE = 'INPUT_CHAR_CHANGE';
const MOVE_PLAYER = 'MOVE_PLAYER';
const DELETE_PLAYER = 'DELETE_PLAYER';
const HANDLE_SLIDE = 'HANDLE_SLIDE';

/**
 * Traitements
 */

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

    case HANDLE_SLIDE:
      return {
        ...state,
        isSlided: !state.isSlided,
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
      if (state.characters.length < 20) {
        console.log(state.characters.length);
        const newChar = {
          id: uuidv4(),
          name: state.typingName,
          color: state.color,
          coordX: state.cptX,
          coordY: state.cptY,
        };
        if (state.cptY >= 380) {
          state.cptY = 100;
          state.cptX += 70;
        }
        state.cptY += 70;
        if (newChar.name.length === 0) {
          newChar.name = `Opponent#${state.cpt}`;
          state.cpt += 1;
        }
        console.log(newChar.name);
        return {
          ...state,
          characters: [...state.characters, newChar],
          typingName: '',
        };
      }
      return {
        ...state,
      };
    }
    case INPUT_CHAR_CHANGE:
      return {
        ...state,
        typingName: action.value,
      };

    case MOVE_PLAYER: {
      const movedChars = state.characters.map((char) => {
        if (char.id === action.value.target.id) {
          console.log('old coords :', char.coordX, char.coordY);
          char.coordX = (action.value.pageX - action.value.offsetX) - 10;
          char.coordY = (action.value.pageY - action.value.offsetY) - 10;
          console.log('new coords :', char.coordX, char.coordY);
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
  type: INPUT_CHAR_CHANGE,
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

export const handleSlide = () => ({
  type: HANDLE_SLIDE,
});
/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
