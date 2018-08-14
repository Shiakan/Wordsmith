/**
 * Import
 */
import React from 'react';

/**
 * Local import
 */
import TextInput from 'src/containers/TextInput';
import Messages from 'src/containers/Messages';
// Composants

// Styles et assets
import './chat.sass';

/**
 * Code
 */
const Chat = () => (
  <div className="chat">
    <Messages />
    <TextInput />
  </div>
);

/**
 * Export
 */
export default Chat;
