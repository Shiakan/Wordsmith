import { EventStream, EventStore } from '@ohtomi/react-whiteboard';
/**
 * Initial State
 */
const initialState = {
  drawColor: '#125c38',
  drawing: false,
  eventStore: new EventStore(),
  eventStream: new EventStream(),
  drawPicker: false,
};

/**
 * Types
 */
export const SHARE_DRAWING = 'SHARE_DRAWING';
export const RECEIVE_DRAWING = 'RECEIVE_DRAWING';
const DRAWING_COLOR = 'DRAWING_COLOR';
const TOGGLE_DRAW_PICKER = 'TOGGLE_DRAW_PICKER';


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
      return {
        ...state,
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

export const receiveDrawing = drawingStore => ({
  type: RECEIVE_DRAWING,
  drawingStore,
});

export const drawingColor = value => ({
  type: DRAWING_COLOR,
  value,
});

export const toggleDrawPicker = () => ({
  type: TOGGLE_DRAW_PICKER,
});
/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
