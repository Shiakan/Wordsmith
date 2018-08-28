/**
 * Import
 */
import React from 'react';
import PropTypes from 'prop-types';
// import ReactTooltip from 'react-tooltip';

/**
 * Local import
 */
// Composants
import logo from '../../assets/img/logoaccident4.png';
// Styles et assets
import './logo.sass';

/**
 * Code
 */
const Logo = ({ help, showHelp }) => (
  <div className="logo" background={logo}>
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
