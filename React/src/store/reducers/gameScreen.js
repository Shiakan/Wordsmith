
/**
 * Initial State
 */
const initialState = {
  board: false,
  map: true,
  grid: true,
  color: '#d4c4fb',
  toggle: false,
  moving: false,
  created: false,
  name: '',
  typingName: '',
  coordX: 0,
  coordY: 0,
};

/**
 * Types
 */
const DO_SOMETHING = 'DO_SOMETHING';
const TOGGLE_SCREEN = 'TOGGLE_SCREEN';
const TOGGLE_GRID = 'TOGGLE_GRID';
const TOGGLE_PICKER = 'TOGGLE_PICKER';
const CHANGE_COLOR = 'CHANGE_COLOR';
const CREATE_PLAYER = 'CREATE_PLAYER';
const INPUT_CHANGE = 'INPUT_CHANGE';
const SUBMIT_NAME = 'SUBMIT_NAME';
const MOVE_PLAYER = 'MOVE_PLAYER';

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

    case CREATE_PLAYER:
      return {
        ...state,
        moving: true,
      };
    case INPUT_CHANGE:
      return {
        ...state,
        typingName: action.value,
      };
    case SUBMIT_NAME:
      return {
        ...state,
        name: state.typingName,
        typingName: '',
      };
    case MOVE_PLAYER:
      return {
        ...state,
        coordX: action.value.pageX,
        coordY: action.value.pageY,
        created: true,
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

export const submitName = () => ({
  type: SUBMIT_NAME,
});
export const movePlayer = value => ({
  type: MOVE_PLAYER,
  value,
});
/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
