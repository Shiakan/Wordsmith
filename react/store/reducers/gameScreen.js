import maps from '../../data/maps';
/**
 * Initial State
 */
const initialState = {
  maps,
  isBoard: false,
  map: 'http://medievalshop.com/parchemin/wp-content/uploads/2013/02/Plan-FG2-Auberge-des-3-anneaux-%C3%A9tage-de-nuit.jpg',
  isMap: true,
  grid: true,
  color: '#4caf50',
  toggle: false,
  isSlided: false,
  cpt: 1,
  cptX: 30,
  cptY: 100,
  name: '',
  typingName: '',
  characters: [],
};
console.log(initialState.characters);

/**
 * Types
 */
const TOGGLE_SCREEN = 'TOGGLE_SCREEN';
const TOGGLE_GRID = 'TOGGLE_GRID';
const TOGGLE_PICKER = 'TOGGLE_PICKER';
const CHANGE_COLOR = 'CHANGE_COLOR';
export const CREATE_PLAYER = 'CREATE_PLAYER';
const INPUT_CHAR_CHANGE = 'INPUT_CHAR_CHANGE';
export const MOVE_PLAYER = 'MOVE_PLAYER';
const RECEIVE_MOVE = 'RECEIVE_MOVE';
const RECEIVE_DELETE = 'RECEIVE_DELETE';
const RECEIVE_CHAR = 'RECEIVE_CHAR';
const RECEIVE_MAP = 'RECEIVE_MAP';
export const DELETE_PLAYER = 'DELETE_PLAYER';
const HANDLE_SLIDE = 'HANDLE_SLIDE';
export const CHANGE_MAP = 'CHANGE_MAP';
export const AUTO_PLAYER = 'AUTO_PLAYER';
export const AUTO_RECEIVE = 'AUTO_RECEIVE';
const UPDATE_CHARS = 'UPDATE_CHARS';


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
        isBoard: !state.isBoard,
        isMap: !state.isMap,
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

    case RECEIVE_MAP:
      return {
        ...state,
        map: action.newMap,
      };

    case AUTO_RECEIVE:
      return {
        ...state,
        characters: [...state.characters, action.autoChar],
      };

    case RECEIVE_CHAR:
      console.log('NEW CHAR REDUCER :', action.newChar);

      return {
        ...state,
        characters: [...state.characters, action.newChar],
      };

    case INPUT_CHAR_CHANGE:
      return {
        ...state,
        typingName: action.value,
      };

    case RECEIVE_MOVE: {
      console.log('receive move action :', action.characters);
      const filteredChars = state.characters.filter(
        char => char.id !== action.characters.id,
      );
      console.log('FILTERED :', filteredChars);

      return {
        ...state,
        characters: [...filteredChars, action.characters],
      };
    }
    case RECEIVE_DELETE: {
      const remainingChars = state.characters.filter(
        char => char.id !== action.characters[0].id,
      );
      // console.log('character to kill :', action.characters[0].name);

      return {
        ...state,
        characters: [...remainingChars],
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

export const autoAddPlayer = tokenToAdd => ({
  type: AUTO_PLAYER,
  char: tokenToAdd,
});

export const updateChars = value => ({
  type: UPDATE_CHARS,
  value,
});

export const movePlayer = value => ({
  type: MOVE_PLAYER,
  value,
});

export const receiveMove = characters => ({
  type: RECEIVE_MOVE,
  characters,
});

export const receiveDelete = characters => ({
  type: RECEIVE_DELETE,
  characters,
});

export const autoReceivePlayer = autoChar => ({
  type: AUTO_RECEIVE,
  autoChar,
});

export const receiveChar = newChar => ({
  type: RECEIVE_CHAR,
  newChar,
});

export const receiveMap = newMap => ({
  type: RECEIVE_MAP,
  newMap,
});

export const deletePlayer = value => ({
  type: DELETE_PLAYER,
  value,
});

export const handleSlide = () => ({
  type: HANDLE_SLIDE,
});

export const changeMap = value => ({
  type: CHANGE_MAP,
  value,
});

/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
