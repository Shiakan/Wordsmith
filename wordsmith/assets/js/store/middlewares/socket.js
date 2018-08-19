/**
 * Import
 */
import io from 'socket.io-client';
import { WEBSOCKET_CONNECT } from '../reducers/user';
/**
 * Code
 */
const socket = io('localhost:3000');

/**
 * Middleware
 */
const socketConnect = store => next => (action) => {
  switch (action.type) {
    case WEBSOCKET_CONNECT: {
      // socket = io('87.98.154.146:3000');
      // connexion au WebSocket TODO localhost window.io(adresseIpDuServ:3000)
      const state = store.getState(action);
      console.log(state.user.roomId, 'ROOM ID');
      socket.emit('join', state.user);
      // A la connexion j'active l'écoute sur 'send message'
      // socket.on('send_message', (message) => {
      //   // Si je reçois un 'send message' je dispatch une action
      //   // De mon reducer afin d'ajouter ce message à mon state
      //   store.dispatch(receiveMessage(message));
      // });
    }
      break;
    // case MESSAGE_ADD: {
    //   // Je transfère l'objet entier
    //   // Découpable par la suite
    //   const message = store.getState(action.message);
    //   socket.emit('send_message', message);
    // }
      // break;

    default:
  }

  // Passage au voisin
  next(action);
};

/**
 * Export
 */
export default socketConnect;
