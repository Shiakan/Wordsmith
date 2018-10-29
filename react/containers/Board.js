/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import Board from 'src/components/GameScreen/Board';

// Action Creators
import {
  shareDrawing,
} from 'src/store/reducers/board';

/* === State (données) ===
 * - mapStateToProps retroune un objet de props pour le composant de présentation
 * - mapStateToProps met à dispo 2 params
 *  - state : le state du store (getState)
 *  - ownProps : les props passées au container
 * Pas de data à transmettre ? const mapStateToProps = null;
 */
const mapStateToProps = state => ({
  drawColor: state.board.drawColor,
  drawing: state.board.drawing,
  eventStream: state.board.eventStream,
  eventStore: state.board.eventStore,
  boardAvailable: state.board.boardAvailable,
  role: state.user.role,
  // color: state.gameScreen.color,
  // name: state.gameScreen.name,
  // coordX: state.gameScreen.coordX,
  // coordY: state.gameScreen.coordY,
});

/* === Actions ===
 * - mapDispatchToProps retroune un objet de props pour le composant de présentation
 * - mapDispatchToProps met à dispo 2 params
 *  - dispatch : la fonction du store pour dispatcher une action
 *  - ownProps : les props passées au container
 * Pas de disptach à transmettre ? const mapDispatchToProps = {};
 */
const mapDispatchToProps = dispatch => ({
  shareDrawing: () => {
    dispatch(shareDrawing());
  },
});

// Container
// connect(Ce dont j'ai besoin)(Qui en a besoin)
const BoardContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(Board);

/* 2 temps
const createContainer = connect(mapStateToProps, mapDispatchToProps);
const BoardContainer = createContainer(Board);
*/

/**
 * Export
 */
export default BoardContainer;
