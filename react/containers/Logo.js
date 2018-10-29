/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import Logo from 'src/components/Logo';
import { showHelp } from 'src/store/reducers/actionBar';
// Action Creators

/* === State (données) ===
 * - mapStateToProps retroune un objet de props pour le composant de présentation
 * - mapStateToProps met à dispo 2 params
 *  - state : le state du store (getState)
 *  - ownProps : les props passées au container
 * Pas de data à transmettre ? const mapStateToProps = null;
 */
const mapStateToProps = state => ({
  help: state.actionBar.help,
});

/* === Actions ===
 * - mapDispatchToProps retroune un objet de props pour le composant de présentation
 * - mapDispatchToProps met à dispo 2 params
 *  - dispatch : la fonction du store pour dispatcher une action
 *  - ownProps : les props passées au container
 * Pas de disptach à transmettre ? const mapDispatchToProps = {};
 */
const mapDispatchToProps = dispatch => ({
  showHelp: () => {
    dispatch(showHelp());
  },
});

// Container
// connect(Ce dont j'ai besoin)(Qui en a besoin)
const LogoContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(Logo);

/**
 * Export
 */
export default LogoContainer;
