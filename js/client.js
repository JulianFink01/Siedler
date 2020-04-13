  var socket;
  socket = io.connect('http://localhost:3000');

  socket.on('info',
    function(text){
      document.getElementById('echotext').innerHTML = text;
    }
  );


function senden(){
  var text =   document.getElementById('text').value;
  socket.emit('info',text);
}
