/**
 * Import
 */
import React from 'react';

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
  state = {
    display: 'Dice',
  }

  componentDidMount() {
    console.log('Panel loaded');
  }

  render() {
    const { display } = this.state;
    return (
      <div className="panel">
        <p>{display}</p>
      </div>
    );
  }
}


/**
 * Export
 */
export default Panel;
