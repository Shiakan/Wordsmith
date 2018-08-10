/**
 * Npm import
 */
import { connect } from 'react-redux';

/**
 * Local import
 */
import Dice from 'src/components/Panel/Dice';

// Action Creators
// import { doSomething } from 'src/store/reducer';
import { rollDice, diceChange } from 'src/store/reducers/dice';

/* === State (données) ===
 * - mapStateToProps retroune un objet de props pour le composant de présentation
 * - mapStateToProps met à dispo 2 params
 *  - state : le state du store (getState)
 *  - ownProps : les props passées au container
 * Pas de data à transmettre ? const mapStateToProps = null;
 */
const mapStateToProps = state => ({
  diceValue: state.dice.diceValue,
  rollResult: state.dice.rolled,
});

/* === Actions ===
 * - mapDispatchToProps retroune un objet de props pour le composant de présentation
 * - mapDispatchToProps met à dispo 2 params
 *  - dispatch : la fonction du store pour dispatcher une action
 *  - ownProps : les props passées au container
 * Pas de disptach à transmettre ? const mapDispatchToProps = {};
 */
const mapDispatchToProps = dispatch => ({
  rollDice: () => {
    dispatch(rollDice());
  },
  diceChange: (value) => {
    dispatch(diceChange(value));
  },
});

// Container
// connect(Ce dont j'ai besoin)(Qui en a besoin)
const DiceContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(Dice);

/**
 * Export
 */
export default DiceContainer;
