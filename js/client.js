var socket;
  socket = io.connect('http://localhost:3000');

  socket.on('info',
    get(text)
  );

function get(text){
    document.getElementById('echotext').innerHTML = text;
}
function senden(){
  var text =   document.getElementById('text').value;
  socket.emit('info',text);
  document.getElementById('echotext').innerHTML = text;
}
