/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';

/**
 * Local import
 */
// Composants
import Dice from '../../containers/Dice';
import Sheet from '../../containers/Sheet';
import Help from './Help';

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
        {help && <Help />}
      </div>
    );
  }
}


/**
 * Export
 */
export default Panel;
