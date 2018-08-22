/**
 * Import
 */
import axios from 'axios';
import { SHEET_UPDATE } from '../reducers/user';
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
        axios.post(`/charactersheet/${state.user.sheetId}`, action.value)
          .then((response) => {
            console.log(response);
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
