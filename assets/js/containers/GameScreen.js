/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import GameScreen from '../components/GameScreen';

// Action Creators
import {
  toggleScreen, handleSlide,
} from '../store/reducers/gameScreen';
import {
  shareDrawing, drawingColor, toggleDrawPicker,
} from '../store/reducers/board';


/* === State (données) ===
 * - mapStateToProps retroune un objet de props pour le composant de présentation
 * - mapStateToProps met à dispo 2 params
 *  - state : le state du store (getState)
 *  - ownProps : les props passées au container
 * Pas de data à transmettre ? const mapStateToProps = null;
 */
const mapStateToProps = state => ({
  isBoard: state.gameScreen.isBoard,
  isMap: state.gameScreen.isMap,
  map: state.gameScreen.map,
  grid: state.gameScreen.grid,
  characters: state.gameScreen.characters,
  isSlided: state.gameScreen.isSlided,
  role: state.user.role,
  drawColor: state.board.drawColor,
  drawPicker: state.board.drawPicker,
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
  toggleScreen: () => {
    dispatch(toggleScreen());
  },
  togglePicker: () => {
    dispatch(toggleDrawPicker());
  },
  handleSlide: () => {
    dispatch(handleSlide());
  },
  shareDrawing: () => {
    dispatch(shareDrawing());
  },
  onChangeColor: (value) => {
    dispatch(drawingColor(value));
  },
});

// Container
// connect(Ce dont j'ai besoin)(Qui en a besoin)
const GameScreenContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(GameScreen);

/* 2 temps
const createContainer = connect(mapStateToProps, mapDispatchToProps);
const GameScreenContainer = createContainer(GameScreen);
*/

/**
 * Export
 */
export default GameScreenContainer;
