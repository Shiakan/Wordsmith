import uuidv4 from 'uuid/v4'; // https://www.npmjs.com/package/uuid
/**
 * Import
 */
import io from 'socket.io-client';
import { WEBSOCKET_CONNECT } from '../reducers/user';
import { ADD_MESSAGE, receiveMessage } from '../reducers/textInput';
import { ROLL_DICE, SHARE_DICE } from '../reducers/dice';
import {
  receiveDelete, autoAddPlayer, deletePlayer,
  AUTO_PLAYER, MOVE_PLAYER, DELETE_PLAYER, CREATE_PLAYER, CHANGE_MAP,
  receiveMove, receiveChar, receiveMap, autoReceivePlayer,
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
      // store.dispatch(movePlayer());
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
      socket.on('delete_token', (tokenToKill) => {
        store.dispatch(deletePlayer(tokenToKill));
      });
      socket.on('receive_auto', (autoChar) => {
        store.dispatch(autoReceivePlayer(autoChar));
      });
      socket.on('receive_add', (newChar) => {
        console.log('new char received websocket :', newChar);
        store.dispatch(receiveChar(newChar));
      });
      socket.on('receive_delete', (charToKill) => {
        console.log('action websocket :', charToKill);
        store.dispatch(receiveDelete(charToKill));
      });
      socket.on('receive_move', (movedChars) => {
        store.dispatch(receiveMove(movedChars));
      });
      socket.on('receive_map', (newMap) => {
        store.dispatch(receiveMap(newMap));
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
      dice.critic = action.critic;
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
      const movedChar = state.gameScreen.characters.filter(
        char => char.id === action.value.target.id,
      );
      const movedChars = state.gameScreen.characters.map((char) => {
        console.log('action.value.target.id', action.value.target.id);
        if (char.id === action.value.target.id) {
          console.log('old coords :', char.coordX, char.coordY);
          char.coordX = action.value.layerX - action.value.offsetX;
          char.coordY = action.value.layerY - action.value.offsetY;
          console.log('new coords :', char.coordX, char.coordY);
        }
        return char;
      });
      console.log('moved char ', movedChar[0]);
      console.log('movedchars ', movedChars);
      socket.emit('move_player', movedChar[0]);
    }

      break;

    case CREATE_PLAYER:
      if (state.gameScreen.characters.length <= 20) {
        console.log(state.gameScreen.characters.length);
        const newChar = {
          id: uuidv4(),
          name: state.gameScreen.typingName,
          color: state.gameScreen.color,
          coordX: state.gameScreen.cptX,
          coordY: state.gameScreen.cptY,
        };
        if (state.gameScreen.cptY >= 250) {
          state.gameScreen.cptY = 30;
          state.gameScreen.cptX += 70;
        }
        state.gameScreen.cptY += 70;

        const compareChars = state.gameScreen.characters.filter(
          char => char.name.startsWith(newChar.name),
        );
        if (compareChars.length >= 1) {
          newChar.name = `${newChar.name}#${compareChars.length + 1}`;
          console.log('compare :', compareChars);
        }
        if (newChar.name.startsWith('#')) {
          newChar.name = `Opponent#${state.gameScreen.cpt}`;
          state.gameScreen.cpt += 1;
        }
        console.log('NEW CHAR SOCKET :', newChar);
        socket.emit('add_player', newChar);
      }
      break;

    case AUTO_PLAYER: {
      console.log('token reducer', action.char.userName);
      const autoChar = {
        id: uuidv4(),
        name: state.user.userName,
        color: state.gameScreen.color,
        coordX: state.gameScreen.cptX,
        coordY: state.gameScreen.cptY,
      };
      if (state.gameScreen.cptY >= 380) {
        state.gameScreen.cptY = 100;
        state.gameScreen.cptX += 70;
      }
      state.gameScreen.cptY += 70;
      console.log('NEW AUTO CHAR SOCKET :', autoChar);
      socket.emit('auto_player', autoChar);
    }

      break;

    case DELETE_PLAYER: {
      const charToDelete = state.gameScreen.characters.filter(char => char.id === action.value.id);
      console.log('charlol ', charToDelete);

      socket.emit('delete_player', charToDelete);
    }
      break;

    case CHANGE_MAP:
      console.log('socket action map : ', action.value);
      socket.emit('change_map', action.value);
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
