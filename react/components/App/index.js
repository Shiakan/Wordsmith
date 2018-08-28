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
import GameScreen from 'src/containers/GameScreen';
import Panel from 'src/containers/Panel';
import Logo from 'src/containers/Logo';
import ActionBar from 'src/containers/ActionBar';
import Chat from 'src/components/Chat';
import Aetherlust from 'src/components/Aetherlust';
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
