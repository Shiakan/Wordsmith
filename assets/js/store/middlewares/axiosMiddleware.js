/**
 * Import
 */
import axios from 'axios';
import { SHEET_UPDATE, sheetLoaded, axiosLoading } from '../reducers/user';
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
            console.log(response);
            store.dispatch(sheetLoaded());
          })
          .catch((error) => {
            console.log(error);
          });
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
