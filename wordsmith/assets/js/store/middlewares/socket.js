/**
 * Import
 */
import io from 'socket.io-client';
import { WEBSOCKET_CONNECT } from '../reducers/user';
import { ADD_MESSAGE, receiveMessage } from '../reducers/textInput';
import { ROLL_DICE } from '../reducers/dice';
/**
 * Code
 */
const socket = io('localhost:3000');

/**
 * Middleware
 */
const socketConnect = store => next => (action) => {
  const state = store.getState();
  switch (action.type) {
    case WEBSOCKET_CONNECT:
      // socket = io('87.98.154.146:3000');
      // connexion au WebSocket TODO localhost window.io(adresseIpDuServ:3000)
      console.log(state.user, 'ROOM ID');
      socket.emit('join', state.user);
      // A la connexion j'active l'écoute sur 'send message'
      socket.on('send_message', (message) => {
        console.log(message, 'Mess in socket');
      // //   // Si je reçois un 'send message' je dispatch une action
      // //   // De mon reducer afin d'ajouter ce message à mon state
        store.dispatch(receiveMessage(message));
      });
    
      break;

    case ADD_MESSAGE: {
      // Je transfère l'objet entier
      // Découpable par la suite
      // const state = store.getState();
      console.log(state.user.userName, 'ADD MESSAGE');
      const content = {};
      content.author = state.user.userName;
      content.message = state.textInput.message;
      socket.emit('send_message', content);
    }
      break;

    case ROLL_DICE:
      console.log(action.dice, 'DICE');
      const dice = {};
      dice.author = state.user.userName;
      dice.rolled = action.dice;
      socket.emit('roll_dice', dice);

      break;

    default:
  }

  // Passage au voisin
  next(action);
};

/**
 * Export
 */
export default socketConnect;
