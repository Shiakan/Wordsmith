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
import './logo.sass';
import logoaccident from '../../assets/img/logoaccident4.png';

/**
 * Code
 */
const Logo = ({ help, showHelp }) => (
  <div
    className="logo"
    style={{
      background: logoaccident,
    }}
  >
    {help
        && (
        <div onClick={showHelp} className="help-over">
          <div id="kcolconeb" />
        </div>
        )}
  </div>
);
Logo.propTypes = {
  help: PropTypes.bool.isRequired,
  showHelp: PropTypes.func.isRequired,
};
/**
 * Export
 */
export default Logo;
