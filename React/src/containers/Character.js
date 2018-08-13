/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import Character from 'src/components/GameScreen/Character';

// Action Creators
import {
  movePlayer, deletePlayer,
} from 'src/store/reducers/gameScreen';

/* === State (données) ===
 * - mapStateToProps retroune un objet de props pour le composant de présentation
 * - mapStateToProps met à dispo 2 params
 *  - state : le state du store (getState)
 *  - ownProps : les props passées au container
 * Pas de data à transmettre ? const mapStateToProps = null;
 */
const mapStateToProps = state => ({
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
const mapDispatchToProps = (dispatch, ownProps) => ({
  movePlayer: (value) => {
    dispatch(movePlayer(value));
  },
  deletePlayer: () => {
    dispatch(deletePlayer(ownProps.id));
  },
});

// Container
// connect(Ce dont j'ai besoin)(Qui en a besoin)
const CharacterContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(Character);

/* 2 temps
const createContainer = connect(mapStateToProps, mapDispatchToProps);
const CharacterContainer = createContainer(Character);
*/

/**
 * Export
 */
export default CharacterContainer;
