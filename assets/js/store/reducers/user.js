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
  tempSheet: '',
  showRequestStatus: false,
  loading: false,
  success: false,
};

/**
 * Types
 */
const DO_SOMETHING = 'DO_SOMETHING';
const SHEET_CHANGE = 'SHEET_CHANGE';
export const AXIOS_LOADING = 'AXIOS_LOADING';
export const AXIOS_LOADED = 'AXIOS_LOADED';
export const SHEET_UPDATE = 'SHEET_UPDATE';
export const SHEET_LOADED = 'SHEET_LOADED';
export const SHEET_FAILED = 'SHEET_FAILED';
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

    case AXIOS_LOADING:
      return {
        ...state,
        showRequestStatus: true,
        loading: true,
      };

    case AXIOS_LOADED:
      return {
        ...state,
        showRequestStatus: false,
      };

    case SHEET_LOADED:
      return {
        ...state,
        loading: false,
        success: true,
      };

    case SHEET_FAILED:
      return {
        ...state,
        loading: false,
        success: false,
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

export const axiosLoading = () => ({
  type: AXIOS_LOADING,
});

export const axiosLoaded = () => ({
  type: AXIOS_LOADED,
});

export const sheetLoaded = () => ({
  type: SHEET_LOADED,
});

export const sheetFailed = value => ({
  type: SHEET_FAILED,
  value,
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
