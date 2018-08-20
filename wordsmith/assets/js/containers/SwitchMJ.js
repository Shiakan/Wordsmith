/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import SwitchMJ from '../components/GameScreen/SwitchMJ';

// Action Creators
import {
  togglePicker, changeColor, changeInput, movePlayer, createPlayer, changeMap,
} from '../store/reducers/gameScreen';

/* === State (données) ===
 * - mapStateToProps retroune un objet de props pour le composant de présentation
 * - mapStateToProps met à dispo 2 params
 *  - state : le state du store (getState)
 *  - ownProps : les props passées au container
 * Pas de data à transmettre ? const mapStateToProps = null;
 */
const mapStateToProps = state => ({
  color: state.gameScreen.color,
  toggle: state.gameScreen.toggle,
  typingName: state.gameScreen.typingName,
  maps: state.gameScreen.maps,
});

/* === Actions ===
 * - mapDispatchToProps retroune un objet de props pour le composant de présentation
 * - mapDispatchToProps met à dispo 2 params
 *  - dispatch : la fonction du store pour dispatcher une action
 *  - ownProps : les props passées au container
 * Pas de disptach à transmettre ? const mapDispatchToProps = {};
 */
const mapDispatchToProps = dispatch => ({
  togglePicker: () => {
    dispatch(togglePicker());
  },
  onChangeColor: (value) => {
    dispatch(changeColor(value));
  },
  createPlayer: () => {
    dispatch(createPlayer());
  },
  onInputChange: (value) => {
    dispatch(changeInput(value));
  },
  onDisplayPlayer: (value) => {
    dispatch(movePlayer(value));
  },
  changeMap: (value) => {
    dispatch(changeMap(value));
  },
});

// Container
// connect(Ce dont j'ai besoin)(Qui en a besoin)
const SwitchMJContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(SwitchMJ);

/* 2 temps
const createContainer = connect(mapStateToProps, mapDispatchToProps);
constSwitchMJContainer = createContainer(Character);
*/

/**
 * Export
 */
export default SwitchMJContainer;
