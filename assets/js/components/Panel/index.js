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
    console.log('Panel loaded');
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
            <FaQuestionCircle data-tip="React-tooltip" className="question" />
            <ReactTooltip
              place="left"
              type="dark"
              effect="float"
              border
            >
              <p className="dice-block-tooltip-text">
                    TEST TEST
              </p>
              <ul className="dice-block-tooltip-ul">
                <li className="dice-block-tooltip-ul-li">x correspond au nombre de dés à lancer</li>
                <li className="dice-block-tooltip-ul-li">D est le séparateur</li>
                <li className="dice-block-tooltip-ul-li">y le nombre de face pour les dés à lancer</li>
              </ul>
              <p className="dice-block-tooltip-text">
                    TEST TEST
              </p>
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
