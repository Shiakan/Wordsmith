/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import { Whiteboard, EventStream, EventStore } from '@ohtomi/react-whiteboard';

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
    drawColor: PropTypes.string.isRequired,
    drawing: PropTypes.bool.isRequired,
    startDrawing: PropTypes.func.isRequired,
    stopDrawing: PropTypes.func.isRequired,
  }

  componentDidMount() {
    // console.log('board loaded');
  }

  render() {
    const {
      drawColor, drawing, startDrawing, stopDrawing,
    } = this.props;
    // console.log(drawing ? 'start drawing' : 'stop drawing');
    return (
      <div
        className="board"
        // onMouseDown={startDrawing}
        // onMouseUp={stopDrawing}
        // onMouseMove={(e) => {
        //   console.log(e.clientX, e.clientY);
        // }}
      >
        <Whiteboard
          width="100%"
          height="100%"
          // events={new EventStream()} eventStore={new EventStore()}
        />
      </div>
    );
  }
}

/**
 * Export
 */
export default Board;
