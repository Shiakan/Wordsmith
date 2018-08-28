/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
import { FaHourglassEnd, FaCheck, FaTimes } from 'react-icons/fa/';

/**
 * Local import
 */
// Composants

// Styles et assets
import './sheet.sass';
import parchment from 'src/assets/img/parchment3.png';

/**
 * Code
 */
class Sheet extends React.Component {
  static propTypes = {
    charSheet: PropTypes.string.isRequired,
    userName: PropTypes.string.isRequired,
    sheetChange: PropTypes.func.isRequired,
    sheetUpdate: PropTypes.func.isRequired,
    success: PropTypes.bool.isRequired,
    loading: PropTypes.bool.isRequired,
    showRequestStatus: PropTypes.bool.isRequired,
  }

  componentDidMount() {
    console.log('Sheet loaded');
    const { userName } = this.props;

    console.log('ICI MARION, USERNAME, ICI', userName);
  }

  handleChange = (evt) => {
    const { sheetChange } = this.props;
    // Je recup la valeur du champ
    const { value } = evt.target;
    // passer la valeur vers le state => disptach avec une action capable de prendre cette valeur
    sheetChange(value);
  }

  focusLeave = (evt) => {
    const { sheetUpdate } = this.props;
    console.log('ON FOCUS OUT', evt.target.value);
    sheetUpdate(evt.target.value);
  }

  render() {
    const {
      charSheet,
      userName,
      success,
      loading,
      showRequestStatus,
    } = this.props;
    return (
      <div className="sheet" background={parchment}>
        <div className="sheet-axios">
          {showRequestStatus
          && (
            <div>
              {loading
                && <div> <FaHourglassEnd /> </div>}
              {!loading
              && (
                <div>
                  {success
                    && <div className="sheet-axios-success"> <FaCheck /> </div>}
                  {!success
                    && <div className="sheet-axios-error"> <FaTimes /> </div>}
                </div>
              )}
            </div>
          )}
        </div>
        <p className="sheet-name">{userName}</p>
        <textarea
          id="sheet-id"
          type="text"
          className="sheet-character"
          placeholder="feuille personnage"
          onChange={this.handleChange}
          value={charSheet}
          // autoFocus
          onBlur={this.focusLeave}
        />
      </div>
    );
  }
}

/**
 * Export
 */
export default Sheet;
