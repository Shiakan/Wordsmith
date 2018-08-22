/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import Sheet from '../components/Panel/Sheet';

// Action Creators
// import { doSomething } from '../store/reducer';
import { sheetChange, sheetUpdate } from '../store/reducers/user';

/* === State (données) ===
 * - mapStateToProps retroune un objet de props pour le composant de présentation
 * - mapStateToProps met à dispo 2 params
 *  - state : le state du store (getState)
 *  - ownProps : les props passées au container
 * Pas de data à transmettre ? const mapStateToProps = null;
 */
const mapStateToProps = state => ({
  charSheet: state.user.charSheet,
  sheetId: state.user.sheetId,
  userName: state.user.userName,
});

/* === Actions ===
 * - mapDispatchToProps retroune un objet de props pour le composant de présentation
 * - mapDispatchToProps met à dispo 2 params
 *  - dispatch : la fonction du store pour dispatcher une action
 *  - ownProps : les props passées au container
 * Pas de disptach à transmettre ? const mapDispatchToProps = {};
 */
const mapDispatchToProps = dispatch => ({
  sheetChange: (value) => {
    dispatch(sheetChange(value));
  },
  sheetUpdate: (value) => {
    dispatch(sheetUpdate(value));
  },
});

// Container
// connect(Ce dont j'ai besoin)(Qui en a besoin)
const SheetContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(Sheet);

/**
 * Export
 */
export default SheetContainer;
