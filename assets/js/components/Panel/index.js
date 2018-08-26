/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import { FaQuestionCircle } from 'react-icons/fa/';
import ReactTooltip from 'react-tooltip';

/**
 * Local import
 */
// Composants
import Dice from '../../containers/Dice';
import Sheet from '../../containers/Sheet';
// import Help from './Help';

// Styles et assets
import './panel.sass';

/**
 * Code
 */
class Panel extends React.Component {
  static propTypes = {
    dice: PropTypes.bool.isRequired,
    sheet: PropTypes.bool.isRequired,
    help: PropTypes.bool.isRequired,
  };

  componentDidMount() {
    // console.log('Panel loaded');
  }

  render() {
    const { dice, sheet, help } = this.props;
    return (
      <div className="panel">
        {dice && <Dice />}
        {sheet && <Sheet />}
        {help
        && (
          <div className="toolTip">
            <FaQuestionCircle data-tip="panel-tooltip" data-for="panel-tooltip" className="question" />
            <ReactTooltip
              id="panel-tooltip"
              place="left"
              type="dark"
              effect="float"
              border
            >
              <p className="question-text">
                    Dés
              </p>
              <ul className="question-ul">
                <li className="question-ul-li">Tapez 1D20 pour lancer 1 dé à 20 faces</li>
                <li className="question-ul-li">2D6 pour lancer 2 dés à 6 faces</li>
                <li className="question-ul-li">Le résultat du lancer sera automatiquement partagé dans le chat</li>
                <li className="question-ul-li">Le Maître du jeu choisit ou non de partager son lancer</li>
              </ul>
              <p className="question-text">
                    Fiche personnage
              </p>
              <ul className="question-ul">
                <li className="question-ul-li">Votre fiche personnage est sauvegardée dès lors que vous cliquez en dehors de la zone de texte</li>
                <li className="question-ul-li">Vous allez la retrouver dans la prochaine partie à laquelle vous participerez</li>
              </ul>
            </ReactTooltip>
          </div>
        )}
      </div>
    );
  }
}


/**
 * Export
 */
export default Panel;
