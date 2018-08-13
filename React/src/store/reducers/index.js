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
import sheet from 'src/store/reducers/sheet';


const reducers = combineReducers({
  actionBar,
  dice,
  gameScreen,
  sheet,
});

/**
 * Export
 */
export default reducers;
