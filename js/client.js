
  //Socket wird erstellt
  var socket;
  socket = io.connect('http://localhost:3000');
  //Wenn eine Msg mit den Namen "info" hereinkommt führt der socket folgende Funktion aus: get()
  socket.on('info',
    get(text)
  );

function get(text){
    document.getElementById('echotext').innerHTML = text;
}

//Socket sendet Information
function senden(){
  var text =   document.getElementById('text').value;
  socket.emit('info',text);
  document.getElementById('echotext').innerHTML = text;
}
