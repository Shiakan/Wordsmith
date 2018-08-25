/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import { Whiteboard } from '@ohtomi/react-whiteboard';

/**
 * Local import
 */
// Composants

// Styles et assets
import './board.sass';

/**
 * Code
 */
class Board extends React.Component {
  static propTypes = {
    drawing: PropTypes.bool.isRequired,
    eventStream: PropTypes.object.isRequired,
    eventStore: PropTypes.object.isRequired,
  }

  componentDidMount() {
    console.log('board loaded');
  }

  render() {
    const {
      drawing, eventStore, eventStream,
    } = this.props;
    console.log(drawing ? 'start drawing' : 'stop drawing');
    return (
      <div
        className="board"
      >
        <Whiteboard
          events={eventStream}
          eventStore={eventStore}
          width="100%"
          height="100%"
        />
      </div>
    );
  }
}

/**
 * Export
 */
export default Board;
