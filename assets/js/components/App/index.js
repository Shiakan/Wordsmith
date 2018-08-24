/**
 * Import
 */
import React from 'react';

/**
 * Local import
 */
// Composants

// Styles et assets
import './app.sass';
import GameScreen from '../../containers/GameScreen';
import Chat from '../Chat';
import Panel from '../../containers/Panel';
import Aetherlust from '../Aetherlust';
import Logo from '../../containers/Logo';
import ActionBar from '../../containers/ActionBar';
// import Footer from '../Footer';


/**
 * Code
 */
const App = () => (
  <div id="app">
    <GameScreen />
    <Panel />
    <Chat />
    <Aetherlust />
    <Logo />
    <ActionBar />
    {/* <Footer /> */}
  </div>
);

/**
 * Export
 */
export default App;
