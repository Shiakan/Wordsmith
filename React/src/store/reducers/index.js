/**
 * npm import
 */
import { combineReducers } from 'redux';

/**
 * Local import
 */
import actionBar from 'src/store/reducers/actionBar';
import dice from 'src/store/reducers/dice';
// import settings from 'src/store/reducers/settings';


const reducers = combineReducers({
  actionBar,
  dice,
  // settings,
});

/**
 * Export
 */
export default reducers;
