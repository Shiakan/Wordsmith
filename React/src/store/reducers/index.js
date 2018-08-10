/**
 * npm import
 */
import { combineReducers } from 'redux';

/**
 * Local import
 */
import actionBar from 'src/store/reducers/actionBar';
import dice from 'src/store/reducers/dice';
import gameScreen from 'src/store/reducers/gameScreen';


const reducers = combineReducers({
  actionBar,
  dice,
  gameScreen,
  // settings,
});

/**
 * Export
 */
export default reducers;
