/**
 * Import
 */
import React from 'react';

/**
 * Local import
 */
// Composants

// Styles et assets
import './help.sass';

/**
 * Code
 */
const Help = () => (
  <div className="help">
    <p className="help-title">Vous trouverez toute l'aide necessaire ici</p>
    <div className="help-body">
      <p className="help-body-nav"> Click <a href="#testLink">here</a> to read chapter 4.</p>
      <ol className="help-body-ol">
        <li className="help-body-ol-li">Pour communiquer avec les autres joueurs, vous pouvez utiliser le chat</li>
        <li className="help-body-ol-li">Le Maitre du Jeu peut choisir de ne communiquer ou non le résultat de son lancer de dés</li>
        <li className="help-body-ol-li">Les résultats des joueurs seront systématiquements reportés dans le chat-log</li>
        <li className="help-body-ol-li">Pour communiquer avec les autres joueurs, vous pouvez utiliser le chat</li>
        <li className="help-body-ol-li">Le Maitre du Jeu peut choisir de ne communiquer ou non le résultat de son lancer de dés</li>
        <li className="help-body-ol-li">Les résultats des joueurs seront systématiquements reportés dans le chat-log</li>
        <li className="help-body-ol-li">Pour communiquer avec les autres joueurs, vous pouvez utiliser le chat</li>
        <li className="help-body-ol-li">Le Maitre du Jeu peut choisir de ne communiquer ou non le résultat de son lancer de dés</li>
        <li className="help-body-ol-li">
          <a name="testLink">
            Les résultats des joueurs seront systématiquements reportés dans le chat-log
          </a>
        </li>
      </ol>

    </div>
  </div>
);

/**
 * Export
 */
export default Help;
