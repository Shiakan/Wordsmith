/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import ReactTooltip from 'react-tooltip';
import { FaQuestionCircle } from 'react-icons/fa/';

/**
 * Local import
 */
// Composants

// Styles et assets
import './logo.sass';

/**
 * Code
 */
const Logo = ({ help, showHelp }) => (
  <div
    className="logo"
  >
    {help
        && (
        <div onClick={showHelp} className="help-over">
          <div
            id="kcolconeb"
            data-for="kcolconeb-tooltip"
            data-tip="kcolconeb-tooltip"
          >
            <ReactTooltip
              id="kcolconeb-tooltip"
              place="left"
              type="dark"
              effect="float"
              border
            >
              <p className="question-text-dialog">
                <div className="question-text-parag">
                Las de ne pas comprendre ce que vous faites ici, vous décidez de vous tourner vers un étrange homme qui semble… léviter au-dessus du sol. Vous ne pouvez pas vraiment discerner son visage à cause de son impressionnante barbe, de la capuche qui lui recouvre la tête et de l’énorme livre intitulé Rituels de Transmutation et Fusion Magique qui semble l’avoir complètement captivé.
                </div>
                <div className="question-text-parag">
                  « Mmmmh ? L’Archimage <span className="kcolconeb-name">Kcolconeb </span> ? Oui, c’est moi, pourquoi ? » fait-il en levant un regard curieux vers vous.
                  « Vous êtes perdu ? Ah. » Ses sourcils se froncent. « C’est embêtant, voyez-vous, j’adorerais vous faire un petit tour du propriétaire, mais j’ai un petit problème de… maléfice à régler, » dit-il en désignant sa barbe qui, maintenant que vous la regardez de plus près, semble s’allonger sans s’arrêter.
                </div>
                <div className="question-text-parag">
                  « Ne vous en faites pas, je reste l’Archimage après tout ! » s’exclame-t-il avant de faire de grands gestes avec ses mains. «
                  <span className="question-tldr">
                    Voilà, suivez les marqueurs en forme de <FaQuestionCircle className="question-help" /> ils vous expliqueront tout ce que vous devez savoir !
                  </span> » Il vous adresse un sourire encourageant, avant de se raviser.
                </div>
                <div className="question-text-parag">
                  « Oh, cependant, évitez l’aile Ouest, nous avons un petit souci de-- » Il s’ébroue. « Rien de bien important, allez, filez ! Et bonne aventure ! »
                </div>
              </p>
            </ReactTooltip>
          </div>
        </div>
        )}
  </div>
);
Logo.propTypes = {
  help: PropTypes.bool.isRequired,
  showHelp: PropTypes.func.isRequired,
};
/**
 * Export
 */
export default Logo;
