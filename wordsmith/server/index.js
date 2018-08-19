/*
 * Require
 */
var express = require('express');
var join = require('path').join;
var Server = require('http').Server;
var socket = require('socket.io');
// var queryString = require('query-string');
// Local import
// var { Users } = require('./utils/users.js');
// var { isRealString } = require('./utils/validation.js');
// Class instanciation
// var users = new Users();

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
var id = 0;
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
  //   socket.join(parsed.room);
  //   users.removeUser(socket.id);
  //   users.addUser(Number(parsed.id), parsed.name, parsed.room);
  //   console.log(users.users);
  //   // console.log('voici la vérité :', paramJson)
  //   socket.on('send_message', function(message) {
  //     message.id = ++id;
  //     io.to(parsed.room).emit('send_message', message);
    });
  // });
});

/*
 * Server
 */
server.listen(3000, function() {
  console.log('listening on *:3000');
});
