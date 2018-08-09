/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';

/**
 * Local import
 */
// Composants

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
        {dice && <p>dice</p>}
        {sheet && <p>sheet</p>}
        {help && <p>help</p>}
      </div>
    );
  }
}


/**
 * Export
 */
export default Panel;
