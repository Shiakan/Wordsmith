/**
 * Import
 */
import io from 'socket.io-client';
import { WEBSOCKET_CONNECT } from '../reducers/user';
import { ADD_MESSAGE, receiveMessage } from '../reducers/textInput';
import { ROLL_DICE, SHARE_DICE } from '../reducers/dice';
import {
  autoAddPlayer, deletePlayer, MOVE_PLAYER, UPDATE_CHARS, receiveMove, receiveUpdate,
} from '../reducers/gameScreen';
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
      socket.emit('join', state.user, state.gameScreen.characters);
      // socket = io('87.98.154.146:3000');
      // connexion au WebSocket TODO localhost window.io(adresseIpDuServ:3000)
      // A la connexion j'active l'écoute sur 'send message'
      socket.on('send_message', (message) => {
        console.log(message, 'Mess in socket');
        // Si je reçois un 'send message' je dispatch une action
        // De mon reducer afin d'ajouter ce message à mon state
        store.dispatch(receiveMessage(message));
      });
      socket.on('add_token', (tokenToAdd) => {
        console.log('token to add :', tokenToAdd);
        store.dispatch(autoAddPlayer(tokenToAdd));
      });
      socket.on('update', (updatedChars) => {
        store.dispatch(receiveUpdate(updatedChars));
      })
      socket.on('delete_token', (tokenToKill) => {
        store.dispatch(deletePlayer(tokenToKill));
      });
      socket.on('receive_move', (movedChars) => {
        store.dispatch(receiveMove(movedChars));
      });

      break;

    case ADD_MESSAGE: {
      // Je transfère l'objet entier
      // Découpable par la suite
      console.log(state.user.userName, 'ADD MESSAGE');
      const content = {};
      content.role = state.user.role;
      content.author = state.user.userName;
      content.message = state.textInput.message;
      socket.emit('send_message', content);
    }
      break;

    case ROLL_DICE: {
      const dice = {};
      dice.diceValue = state.dice.diceValue;
      dice.role = state.user.role;
      dice.author = state.user.userName;
      dice.rolled = action.dice;
      console.log(dice, 'DICE IN SOCKET');
      socket.emit('roll_dice', dice);
    }
      break;

    case SHARE_DICE: {
      console.log(state.user.userName, 'ADD MESSAGE');
      const dice = {};
      dice.diceValue = state.dice.diceValue;
      dice.author = state.user.userName;
      dice.rolled = state.dice.rolled;
      socket.emit('share_dice', dice);
    }
      break;

    case MOVE_PLAYER: {
      const movedChar = state.gameScreen.characters.filter(char => char.id === action.value.target.id);
      const movedChars = state.gameScreen.characters.map((char) => {
        console.log('action.value.target.id', action.value.target.id);
        if (char.id === action.value.target.id) {
          console.log('old coords :', char.coordX, char.coordY);
          char.coordX = action.value.layerX + 32;
          char.coordY = action.value.layerY;
          console.log('new coords :', char.coordX, char.coordY);
        }
        return char;
      });
      console.log('moved char ', movedChar[0]);
      console.log('movedchars ', movedChars);
      socket.emit('move_player', movedChar[0]);
    }

      break;

    case UPDATE_CHARS:
      console.log('A ENVOYER AUX AUTRES : ', state.gameScreen.characters);
      socket.emit('to_update', state.gameScreen.characters);
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
