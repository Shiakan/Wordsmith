/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import GameScreen from 'src/components/GameScreen';

// Action Creators
import { toggleScreen } from 'src/store/reducers/gameScreen';

/* === State (données) ===
 * - mapStateToProps retroune un objet de props pour le composant de présentation
 * - mapStateToProps met à dispo 2 params
 *  - state : le state du store (getState)
 *  - ownProps : les props passées au container
 * Pas de data à transmettre ? const mapStateToProps = null;
 */
const mapStateToProps = state => ({
  board: state.gameScreen.board,
  map: state.gameScreen.map,
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
