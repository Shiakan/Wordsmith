import { EventStream, EventStore } from '@ohtomi/react-whiteboard';
/**
 * Initial State
 */
const initialState = {
  drawColor: '#f44336',
  drawing: false,
  eventStore: new EventStore(),
  eventStream: new EventStream(),
  drawPicker: false,
  boardAvailable: false,
};

/**
 * Types
 */
export const SHARE_DRAWING = 'SHARE_DRAWING';
export const RECEIVE_DRAWING = 'RECEIVE_DRAWING';
const DRAWING_COLOR = 'DRAWING_COLOR';
const TOGGLE_DRAW_PICKER = 'TOGGLE_DRAW_PICKER';
const RESET_DRAWING = 'RESET_DRAWING';
export const SEND_RESET = 'SEND_RESET';
const DISABLE_BUTTON = 'DISABLE_BUTTON';


/**
 * Traitements
 */

/**
 * Reducer
 */
const reducer = (state = initialState, action = {}) => {
  switch (action.type) {
    // input controllé
    case RECEIVE_DRAWING: {
      const newGoodEvents = action.drawingStore;
      const newEventStore = state.eventStore;
      newEventStore.goodEvents = newGoodEvents;
      console.log('board ?', state.boardAvailable);
      
      return {
        ...state,
        boardAvailable: true,
        eventStore: newEventStore,
      };
    }
    case DRAWING_COLOR:
      return {
        ...state,
        drawColor: action.value,
      };
    case TOGGLE_DRAW_PICKER:
      return {
        ...state,
        drawPicker: !state.drawPicker,
      };
    case RESET_DRAWING:
      return {
        ...state,
        eventStore: new EventStore(),
        eventStream: new EventStream(),
      };
    case DISABLE_BUTTON:
      return {
        ...state,
        boardAvailable: false,
      };

    default:
      return state;
  }
};

/**
 * Action Creators
 */
export const shareDrawing = () => ({
  type: SHARE_DRAWING,
});

export const resetDrawing = () => ({
  type: RESET_DRAWING,
});

export const receiveDrawing = drawingStore => ({
  type: RECEIVE_DRAWING,
  drawingStore,
});

export const drawingColor = value => ({
  type: DRAWING_COLOR,
  value,
});

export const disableButton = () => ({
  type: DISABLE_BUTTON,
})

export const toggleDrawPicker = () => ({
  type: TOGGLE_DRAW_PICKER,
});
export const sendReset = () => ({
  type: SEND_RESET,
});
/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
