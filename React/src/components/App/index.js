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
import GameScreen from 'src/components/GameScreen';
import Chat from 'src/components/Chat';
import Panel from 'src/components/Panel';
import Logo from 'src/components/Logo';
import ActionBar from 'src/components/ActionBar';
import Footer from 'src/components/Footer';


/**
 * Code
 */
const App = () => (
  <div id="app">
    <GameScreen />
    <Panel />
    <Chat />
    <Logo />
    <ActionBar />
    <Footer />
  </div>
);

/**
 * Export
 */
export default App;
