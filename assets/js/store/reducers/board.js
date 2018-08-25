import uuidv4 from 'uuid/v4'; // https://www.npmjs.com/package/uuid
import { EventStream, EventStore } from '@ohtomi/react-whiteboard';
/**
 * Initial State
 */
const initialState = {
  drawColor: 'black',
  drawing: false,
  eventStore: new EventStore(),
  eventStream: new EventStream(),
};

/**
 * Types
 */
export const SHARE_DRAWING = 'SHARE_DRAWING';
export const RECEIVE_DRAWING = 'RECEIVE_DRAWING';


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
/**
 * Selectors
 */

/**
 * Export
 */
export default reducer;
