/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import Panel from 'src/components/Panel';

// Action Creators
// import { doSomething } from 'src/store/reducer';

/* === State (données) ===
 * - mapStateToProps retroune un objet de props pour le composant de présentation
 * - mapStateToProps met à dispo 2 params
 *  - state : le state du store (getState)
 *  - ownProps : les props passées au container
 * Pas de data à transmettre ? const mapStateToProps = null;
 */
const mapStateToProps = state => ({
  dice: state.actionBar.dice,
  sheet: state.actionBar.sheet,
  help: state.actionBar.help,
});

/* === Actions ===
 * - mapDispatchToProps retroune un objet de props pour le composant de présentation
 * - mapDispatchToProps met à dispo 2 params
 *  - dispatch : la fonction du store pour dispatcher une action
 *  - ownProps : les props passées au container
 * Pas de disptach à transmettre ? const mapDispatchToProps = {};
 */
const mapDispatchToProps = {};

// Container
// connect(Ce dont j'ai besoin)(Qui en a besoin)
const PanelContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(Panel);

/**
 * Export
 */
export default PanelContainer;
