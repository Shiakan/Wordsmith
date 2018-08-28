/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import TextInput from '../components/Chat/TextInput';

// Action Creators
import { changeInput, addMessage } from '../store/reducers/textInput';

/* === State (données) === */
const mapStateToProps = state => ({
  message: state.textInput.message,
});

/* === Actions === */
const mapDispatchToProps = dispatch => ({
  onInputChange: (value) => {
    // Je dispatch une action : action INPUT_CHANGE en lui passant la value du champ
    dispatch(changeInput(value));
  },
  onAddMessage: () => {
    dispatch(addMessage());
  },
});

// Container
// connect(Ce dont j'ai besoin)(Qui en a besoin)
const TextInputContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(TextInput);

/**
 * Export
 */
export default TextInputContainer;
