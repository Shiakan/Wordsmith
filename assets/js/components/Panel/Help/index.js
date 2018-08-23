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
      <p className="help-body-nav"> En cliquant <a className="help-body-link" href="#testLink">ici</a>, la navigation sera plus rapide.</p>
      <ol className="help-body-ol">
        <li className="help-body-ol-li">Pour communiquer avec les autres joueurs, vous pouvez utiliser le chat</li>
        <li className="help-body-ol-li">Le Maître du Jeu peut choisir de communiquer ou non le résultat de son lancer de dés</li>
        <li className="help-body-ol-li">Les résultats des joueurs seront systématiquements reportés dans le chat-log</li>
        <li className="help-body-ol-li">Vous pouvez déplacer vos propres pions. Le Maître de jeu peut tous les déplacer</li>
        <li className="help-body-ol-li">Le Maître du Jeu peut téléporter les joueurs sur une autre carte, grâce au menu sur la droite</li>
        <li className="help-body-ol-li">Il pourra également ajouter des ennemis dans ce menu</li>
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
