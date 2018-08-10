/**
 * npm import
 */
import { combineReducers } from 'redux';

/**
 * Local import
 */
import actionBar from 'src/store/reducers/actionBar';
// import form from 'src/store/reducers/form';
// import settings from 'src/store/reducers/settings';


const reducers = combineReducers({
  actionBar,
  // form,
  // settings,
});

/**
 * Export
 */
export default reducers;
