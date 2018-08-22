/**
 * Import
 */
import axios from 'axios';
import {
  SHEET_UPDATE,
  sheetLoaded,
  sheetFailed,
  axiosLoading,
  axiosLoaded,
} from '../reducers/user';
/**
 * Code
 */

/**
 * Middleware
 */
const axiosMiddleware = store => next => (action) => {
  const state = store.getState();
  switch (action.type) {
    case SHEET_UPDATE:
      if (state.user.tempSheet !== action.value) {
        console.log('AXIOS TRIGGERED');

        store.dispatch(axiosLoading());

        axios.post(`/charactersheet/${state.user.sheetId}`, action.value)
          .then((response) => {
            console.log('AXIOS DONE', response);
            store.dispatch(sheetLoaded());
            
            setInterval(() => {
              store.dispatch(axiosLoaded());
            }, 1000);
          })
          .catch((error) => {
            console.log(error);
            store.dispatch(sheetFailed());
            setInterval(() => {
              store.dispatch(axiosLoaded());
            }, 1000);
          });
      }
      else {
        store.dispatch(axiosLoaded());
      }

      break;

    default:
  }

  // Passage au voisin
  next(action);
};

/**
 * Export
 */
export default axiosMiddleware;
