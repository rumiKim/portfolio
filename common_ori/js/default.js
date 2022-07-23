
var backspace = function(){
  var val_keypad = document.getElementById('val_keypad').value;

  document.getElementById('val_keypad').value=val_keypad.substring(0,val_keypad.length -1);
}
