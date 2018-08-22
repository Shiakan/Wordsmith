/*
 * Require
 */
var express = require('express');
var join = require('path').join;
var Server = require('http').Server;
var socket = require('socket.io');
var uuidV4 = require('uuid/v4');
// Local import
var { Users } = require('./utils/users.js');
// var { isRealString } = require('./utils/validation.js');
// Class instanciation
var users = new Users();

/*
* Vars
*/
var app = express();
var server = Server(app);
var io = socket(server);

/*
* Express
 */
app.use(function(req, res, next) {
  res.header('Access-Control-Allow-Origin', '*');
  res.header('Access-Control-Allow-Credentials', true);
  res.header('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
  res.header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');
  next();
});

/*
* Socket.io
 */
io.on('connection', function(socket) {
  // users.addUser(12, 'Jackson', 'Chambre');
  
  // console.log(users);
  console.log('>> socket.io - connected');
  socket.on('join', function(param, callback) {
    console.log('>> JOINED <<', param);
    socket.join(param.roomId);
    users.removeUser(param.selfId);
    users.addUser(param.selfId, param.userName, param.roomId);
    var message = {};
    message.message = 'Vient de se connecter';
    message.author = param.userName;
    message.id = uuidV4();
    io.to(param.roomId).emit('send_message', message);
    console.log(users);

    var tokenToAdd = {};
    tokenToAdd.userName = param.userName,
    io.to(param.roomId).emit('add_token', tokenToAdd);
    

    socket.on('roll_dice', function(dice) {
      var message = {};
      message.dice = dice.rolled;
      message.author = dice.author;
      message.id = uuidV4();
      message.diceValue = dice.diceValue;
      console.log(message, 'DICE IN SERVER')
      if (dice.role === 'player' && !isNaN(dice.rolled)) {
        io.to(param.roomId).emit('send_message', message);
      }
    });

    socket.on('change_map', function(newMap) {
      console.log('NEW MAP SERVER', newMap);
      io.to(param.roomId).emit('receive_map', newMap);
    });

    socket.on('auto_player', function(autoChar) {
      console.log('NEW AUTO CHAR SERVER', autoChar);
      io.to(param.roomId).emit('receive_auto', autoChar);
    });

    socket.on('add_player', function(newChar) {
      console.log('NEW CHAR SERVER', newChar);
      io.to(param.roomId).emit('receive_add', newChar);
    });

    socket.on('move_player', function(movedChars) {
      console.log('RECEIVE MOVE', movedChars);
      io.to(param.roomId).emit('receive_move', movedChars);
    });

    socket.on('share_dice', function(dice) {
      var message = {};
      message.diceValue = dice.diceValue;
      message.dice = dice.rolled;
      message.author = `[MJ] ${dice.author}`;
      message.id = uuidV4();
      if (!isNaN(dice.rolled)) {
        io.to(param.roomId).emit('send_message', message);
      }
    });

    socket.on('delete_player', function(charToDelete) {
      console.log('TOKEN TO DELETE :', charToDelete);
      io.to(param.roomId).emit('receive_delete', charToDelete);
    });
    
    socket.on('send_message', function(messageContent) {
      var message = {};
      message.message = messageContent.message;
      if (messageContent.role === 'player') {
        message.author = messageContent.author;
      } else {
        message.author = `[MJ] ${messageContent.author}`;
      }
      message.id = uuidV4();
      console.log(message, 'on send_message');
      io.to(param.roomId).emit('send_message', message);
    });

    socket.on('disconnect', function () {
      console.log('DISCONNECTION')
      var message = {};
      message.message = 'Vient de se déconnecter';
      message.author = param.userName;
      message.id = uuidV4();
      io.to(param.roomId).emit('send_message', message);
      var tokenToKill = {};
      tokenToKill.userName = param.userName,
      io.to(param.roomId).emit('delete_token', tokenToKill);
    });
  });
});

/*
 * Server
 */
server.listen(3000, function() {
  console.log('listening on *:3000');
});
