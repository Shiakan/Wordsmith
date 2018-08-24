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

/**
 * Code
 */
const Logo = ({ help, showHelp }) => (
  <div className="logo">
    {help
        && <div onClick={showHelp} className="help-over" />}
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
