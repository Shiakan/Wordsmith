const rootAnchor = document.getElementById('root');

/**
 * Initial State
 */
const initialState = {
  userName: rootAnchor.dataset.name,
  role: rootAnchor.dataset.role,
  sheetId: rootAnchor.dataset.sheetid,
  roomId: rootAnchor.dataset.room,
  selfId: rootAnchor.dataset.playerid,
  charSheet: JSON.parse(rootAnchor.dataset.sheet),
  tempSheet: JSON.parse(rootAnchor.dataset.sheet),
};

/**
 * Types
 */
const DO_SOMETHING = 'DO_SOMETHING';
const SHEET_CHANGE = 'SHEET_CHANGE';
export const SHEET_UPDATE = 'SHEET_UPDATE';
export const WEBSOCKET_CONNECT = 'WEBSOCKET_CONNECT';

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

    case WEBSOCKET_CONNECT:
      return {
        ...state,
        // A la connexion au socket
        // J'attribue un id unique à chaque User
        // Afin de permettre de déterminer qui à envoyé le message
        // userId: uuidv4(),
      };

    case SHEET_CHANGE:
      return {
        ...state,
        charSheet: action.value,
      };

    case SHEET_UPDATE:
      return {
        ...state,
        tempSheet: action.value,
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

export const sheetChange = value => ({
  type: SHEET_CHANGE,
  value,
});

export const sheetUpdate = value => ({
  type: SHEET_UPDATE,
  value,
});

export const websocketConnect = () => ({
  type: WEBSOCKET_CONNECT,
});
/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
