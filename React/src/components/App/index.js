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
import Chat from 'src/components/Chat';
import Panel from 'src/containers/Panel';
import Aetherlust from 'src/components/Aetherlust';
import Logo from 'src/components/Logo';
import ActionBar from 'src/containers/ActionBar';
import Footer from 'src/components/Footer';


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
    <Footer />
  </div>
);

/**
 * Export
 */
export default App;
