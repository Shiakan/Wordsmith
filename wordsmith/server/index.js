/*
 * Require
 */
var express = require('express');
var join = require('path').join;
var Server = require('http').Server;
var socket = require('socket.io');
var uuidV4 = require('uuid/v4');
// var queryString = require('query-string');
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
    // const parsed = queryString.parse(param);
    // if (!empty(param)) {
    //   if (!isRealString(param.name) /*|| !isRealString(param.room)*/) {
    //     return callback('Vous devez être enregir');
    //   }
      
    // }
    // je transforme les queryString en URL en objet
    // ?name=Nom&room=roomName => {name:'Nom',room:'roomName'}
    socket.join(param.roomId);
    users.removeUser(socket.id);
    users.addUser(param.selfId, param.userName, param.roomId);
    console.log(users);
  //   // console.log('voici la vérité :', paramJson)
    socket.on('send_message', function(messageContent) {
      var message = {};
      message.message = messageContent.message;
      message.author = messageContent.author;
      message.id = uuidV4();
      console.log(message, 'on send_message');
      io.to(param.roomId).emit('send_message', message);

      socket.on('disconnect', function () {
        console.log('DISCONNECTION')
        var message = {};
        message.message = 'Vient de se déconnecter';
        message.author = messageContent.author;
        message.id = uuidV4();
        io.to(param.roomId).emit('send_message', message);
      });
    });
  });
});

/*
 * Server
 */
server.listen(3000, function() {
  console.log('listening on *:3000');
});
