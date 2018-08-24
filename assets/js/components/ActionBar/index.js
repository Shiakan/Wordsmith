/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import { FaChessPawn, FaUserTie, FaQuestionCircle } from 'react-icons/fa/';
import ReactTooltip from 'react-tooltip';
/**
 * Local import
 */
// Composants

// Styles et assets
import './actionbar.sass';

/**
 * Code
 */
class ActionBar extends React.Component {
  static propTypes = {
    showDice: PropTypes.func.isRequired,
    showSheet: PropTypes.func.isRequired,
    showHelp: PropTypes.func.isRequired,
    help: PropTypes.bool.isRequired,
  };

  componentDidMount() {
    console.log('ActionBar loaded');
  }

  render() {
    const {
      showDice,
      showSheet,
      showHelp,
      help,
    } = this.props;
    return (
      <div className="actionBar">
        {help
        && (
          <div className="toolTip">
            <FaQuestionCircle data-tip="ActionBar-tooltip" data-for="ActionBar-tooltip" className="question" />
            <ReactTooltip
              id="ActionBar-tooltip"
              place="left"
              type="dark"
              effect="float"
              border
            >
              <p className="question-text">
                    Boutons
              </p>
              <ul className="question-ul">
                <li className="question-ul-li">Dés affiche l'interface de jets de dés</li>
                <li className="question-ul-li">Fiche vous permet de consulter et modifier votre fiche de personnage</li>
                <li className="question-ul-li">Cliquez sur Help à tout moment pour obtenir toutes les informations nécessaires</li>
              </ul>
            </ReactTooltip>
          </div>
        )}
        <FaUserTie className="actionBar-mj" />
        <div className="actionBar-table">
          <button onClick={showDice} type="button" className="actionBar-table-dice">DÉS</button>
          <button onClick={showSheet} type="button" className="actionBar-table-sheet">FICHE</button>
          <button onClick={showHelp} type="button" className="actionBar-table-help">HELP</button>
        </div>
        <div className="actionBar-player">
          <FaChessPawn className="actionBar-player-1" />
          <FaChessPawn className="actionBar-player-2" />
          <FaChessPawn className="actionBar-player-3" />
          <FaChessPawn className="actionBar-player-4" />
        </div>
      </div>
    );
  }
}

/**
 * Export
 */
export default ActionBar;
