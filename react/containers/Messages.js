/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import Messages from '../components/Chat/Messages';

// Action Creators

/* === State (données) === */
const mapStateToProps = state => ({
  messages: state.textInput.messages,
  help: state.actionBar.help,
});

/* === Actions === */
const mapDispatchToProps = {};

// Container
// connect(Ce dont j'ai besoin)(Qui en a besoin)
const MessagesContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(Messages);

/**
 * Export
 */
export default MessagesContainer;
