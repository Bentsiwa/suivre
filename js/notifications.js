var gcm = require('../node_modules/node-gcm/lib/node-gcm');

var message = new gcm.Message();

message.addData('hello', 'world');
message.addNotification('title', 'Hello');
message.addNotification('icon', 'ic_launcher');
message.addNotification('body', 'World');


//Add your mobile device registration tokens here
var regTokens = ['ecG3ps_bNBk:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxXl7TDJkW'];
//Replace your developer API key with GCM enabled here
var sender = new gcm.Sender('AIzaSyA5eScgNYWfnCjtmP7e22aYos4Zdn7h_kE');

sender.send(message, regTokens, function (err, response) {
    if(err) {
      console.error(err);
    } else {
      console.log(response);
    }
});


// var gcm = require('node-gcm');

// // Set up the sender with your GCM/FCM API key (declare this once for multiple messages)
// var sender = new gcm.Sender('YOUR_API_KEY_HERE');

// // Prepare a message to be sent
// var message = new gcm.Message({
//     data: { key1: 'msg1' }
// });

// // Specify which registration IDs to deliver the message to
// var regTokens = ['YOUR_REG_TOKEN_HERE'];

// // Actually send the message
// sender.send(message, { registrationTokens: regTokens }, function (err, response) {
//     if (err) console.error(err);
//     else console.log(response);
});