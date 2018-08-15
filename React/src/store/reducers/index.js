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
import textInput from 'src/store/reducers/textInput';
import messages from 'src/store/reducers/messages';


const reducers = combineReducers({
  actionBar,
  dice,
  gameScreen,
  sheet,
  textInput,
  messages,
});

/**
 * Export
 */
export default reducers;
