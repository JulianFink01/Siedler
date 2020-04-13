//Libary wird geladen
var express = require('express');
var app = express();
var server = app.listen(process.env.PORT || 3000, listen);

//Server schaut ob verbindungen existieren
function listen() {
  var host = server.address().address;
  var port = server.address().port;
  console.log('listening at http://' + host + ':' + port);
}
//Socket wird erstellt
app.use(express.static('public'));
var io = require('socket.io')(server);
//Socket wird auf connection erstellt
io.sockets.on('connection',
  //Wenn neue Verbindung wird hier gelistet
  function (socket) {
    console.log("New Client: " + socket.id);
    //Bei Socket msg mit den Namen "info" reagiert der Socket und führt die folgende Funktion aus
    socket.on('info',
      function(text) {
        console.log("Received: 'text' " + text);
        //Sockete wird an alle Teilnhemer weitergeleitet
        socket.broadcast.emit('info', text);
      }
    );

    //Bei disconnection
    socket.on('disconnect', function() {
      console.log("Client has disconnected");
    });
  }
);
