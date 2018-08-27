/**
 * npm import
 */
import { combineReducers } from 'redux';

/**
 * Local import
 */
import actionBar from './actionBar';
import dice from './dice';
import gameScreen from './gameScreen';
import sheet from './sheet';
import textInput from './textInput';
import messages from './messages';
import user from './user';
import board from './board';


const reducers = combineReducers({
  actionBar,
  dice,
  gameScreen,
  sheet,
  textInput,
  messages,
  user,
  board,
});

/**
 * Export
 */
export default reducers;
