/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import SwitchMap from '../components/GameScreen/SwitchMap';

// Action Creators
import {
  toggleScreen, toggleGrid,
} from '../store/reducers/gameScreen';

/* === State (données) ===
 * - mapStateToProps retroune un objet de props pour le composant de présentation
 * - mapStateToProps met à dispo 2 params
 *  - state : le state du store (getState)
 *  - ownProps : les props passées au container
 * Pas de data à transmettre ? const mapStateToProps = null;
 */
const mapStateToProps = state => ({
  grid: state.gameScreen.grid,
  role: state.user.role,
  boardAvailable: state.board.boardAvailable,
});

/* === Actions ===
 * - mapDispatchToProps retroune un objet de props pour le composant de présentation
 * - mapDispatchToProps met à dispo 2 params
 *  - dispatch : la fonction du store pour dispatcher une action
 *  - ownProps : les props passées au container
 * Pas de disptach à transmettre ? const mapDispatchToProps = {};
 */
const mapDispatchToProps = dispatch => ({
  toggleScreen: () => {
    dispatch(toggleScreen());
  },
  toggleGrid: () => {
    dispatch(toggleGrid());
  },
});

// Container
// connect(Ce dont j'ai besoin)(Qui en a besoin)
const SwitchMapContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(SwitchMap);

/* 2 temps
const createContainer = connect(mapStateToProps, mapDispatchToProps);
constSwitchMapContainer = createContainer(Character);
*/

/**
 * Export
 */
export default SwitchMapContainer;
