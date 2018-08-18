/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import ActionBar from '../components/ActionBar';

// Action Creators
import {
  doSomething,
  showDice,
  showSheet,
  showHelp,
} from '../store/reducers/actionBar';

/* === State (données) ===
 * - mapStateToProps retroune un objet de props pour le composant de présentation
 * - mapStateToProps met à dispo 2 params
 *  - state : le state du store (getState)
 *  - ownProps : les props passées au container
 * Pas de data à transmettre ? const mapStateToProps = null;
 */
const mapStateToProps = state => ({

});

/* === Actions ===
 * - mapDispatchToProps retroune un objet de props pour le composant de présentation
 * - mapDispatchToProps met à dispo 2 params
 *  - dispatch : la fonction du store pour dispatcher une action
 *  - ownProps : les props passées au container
 * Pas de disptach à transmettre ? const mapDispatchToProps = {};
 */
const mapDispatchToProps = dispatch => ({
  doSomething: () => {
    dispatch(doSomething());
  },
  showDice: () => {
    dispatch(showDice());
  },
  showSheet: () => {
    dispatch(showSheet());
  },
  showHelp: () => {
    dispatch(showHelp());
  },
});

// Container
// connect(Ce dont j'ai besoin)(Qui en a besoin)
const ActionBarContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(ActionBar);

/**
 * Export
 */
export default ActionBarContainer;
