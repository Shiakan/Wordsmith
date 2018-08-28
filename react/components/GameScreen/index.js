/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import classNames from 'classnames';
import {
  FaAngleDoubleRight,
  FaAngleDoubleLeft,
  FaPalette,
  FaQuestionCircle,
  FaTimesCircle,
} from 'react-icons/fa';
import { CirclePicker } from 'react-color';
import ReactTooltip from 'react-tooltip';
/**
 * Local import
*/
// Composants
import Character from 'src/containers/Character';
import SwitchMap from 'src/containers/SwitchMap';
import SwitchMJ from 'src/containers/SwitchMJ';
import Board from 'src/containers/Board';


// Styles et assets
import './gamescreen.sass';

/**
 * Code
 */
class GameScreen extends React.Component {
  static propTypes = {
    toggleScreen: PropTypes.func.isRequired,
    isBoard: PropTypes.bool.isRequired,
    map: PropTypes.string.isRequired,
    isMap: PropTypes.bool.isRequired,
    grid: PropTypes.bool.isRequired,
    characters: PropTypes.arrayOf(PropTypes.object.isRequired).isRequired,
    handleSlide: PropTypes.func.isRequired,
    isSlided: PropTypes.bool.isRequired,
    help: PropTypes.bool.isRequired,
    role: PropTypes.string.isRequired,
    shareDrawing: PropTypes.func.isRequired,
    togglePicker: PropTypes.func.isRequired,
    onChangeColor: PropTypes.func.isRequired,
    drawColor: PropTypes.string.isRequired,
    drawPicker: PropTypes.bool.isRequired,
    sendReset: PropTypes.func.isRequired,
  };

  componentDidMount() {
    console.log('gameScreen loaded');
  }

  shouldComponentUpdate = (nextProps, nextState) => {
    console.log('CSU CSU CSU', nextProps, nextState);
    return true;
  }

  changeColor = (color) => {
    const { onChangeColor, togglePicker } = this.props;
    onChangeColor(color.hex);
    togglePicker();
  }

  render() {
    const {
      toggleScreen, isBoard, map, isMap,
      grid, characters, handleSlide, isSlided,
      role, shareDrawing, drawColor, togglePicker, drawPicker, help, sendReset,
    } = this.props;
    const classSwitch = classNames(
      'screen-switch',
      {
        'screen-switch--active': isSlided,
        'screen-switch--notAMj': role !== 'dm',
      },
    );
    const classArrow = classNames(
      'screen-switch-arrow',
      {
        'screen-switch-arrow--board': isBoard || role !== 'dm',
      },
    );
    return (
      <div className="screen">
        <div
          className={classSwitch}
        >

          {isMap
            && (
            <div className="screen-switch-form">
              <SwitchMap />
              {role === 'dm' && <SwitchMJ /> }
            </div>
            ) }
          {isBoard
            && (
            <div>
              <button
                type="button"
                className="screen-switch-button"
                onClick={toggleScreen}
              >
            Switch to Map
              </button>
              {role === 'dm'
                && (
                  <div
                    className="screen-switch-board"
                  >
                    <button
                      type="button"
                      className="screen-switch-share"
                      onClick={shareDrawing}
                    >Share Board
                    </button>
                    <div className="screen-switch-icons">
                      <FaPalette
                        className="screen-switch-icon"
                        style={{ color: drawColor }}
                        onClick={togglePicker}
                      />
                      <FaTimesCircle
                        onClick={sendReset}
                        style={{ color: drawColor }}
                        className="screen-switch-icon"
                      />
                    </div>
                  </div>
                )
              }
              {drawPicker
                && (
                <div>
                  <span
                    className="screen-switch-span"
                  >
                    Choose color :
                  </span>
                  <CirclePicker
                    className="screen-switch-picker"
                    color={drawColor}
                    circleSize={17}
                    circleSpacing={8}
                    width="180px"
                    onChange={this.changeColor}
                    triangle="hide"
                  />
                </div>
                )
              }
            </div>
            ) }
          {isSlided ? (
            <FaAngleDoubleLeft
              className={classArrow}
              onClick={handleSlide}
            />
          ) : (
            <FaAngleDoubleRight
              className={classArrow}
              onClick={handleSlide}
            />
          )}
        </div>
        {isMap && (
        <div className="screen-map">
          {help
              && (
                <div className="toolTip">
                  <FaQuestionCircle data-tip="Gamescreen-tooltip" data-for="Gamescreen-tooltip" className="question" />
                  <ReactTooltip
                    id="Gamescreen-tooltip"
                    place="left"
                    type="dark"
                    effect="float"
                    border
                  >
                    <p className="question-text">
                          Déplacements :
                    </p>
                    <ul className="question-ul">
                      <li className="question-ul-li">Vous pouvez déplacez vos pions sur la map pour faire savoir à vos compagnons où vous vous rendez</li>
                      <li className="question-ul-li">Le Maître du jeu peut déplacer tous les pions</li>
                    </ul>
                    <p className="question-text">
                    Grâce au menu sur la gauche de l'écran :
                    </p>
                    <ul className="question-ul">
                      <li className="question-ul-li">Vous savez qui est présent avec vous dans la partie</li>
                      <li className="question-ul-li">Vous affichez ou non un quadrillage sur la map</li>
                      <li className="question-ul-li">Le Maître de jeu peut créer de nouveaux pions et téléporter les joueurs sur une autre carte</li>
                    </ul>
                  </ReactTooltip>
                </div>
              )}
          {characters.map(character => (
            <Character
              key={character.id}
              {...character}
            />
          ))}
          {grid && <div className="screen-map-grid" />}
          <img
            src={map}
            alt="map"
            className="screen-map-image"
          />

        </div>
        ) }
        {isBoard && <Board /> }
      </div>
    );
  }
}

/**
 * Export
 */
export default GameScreen;
