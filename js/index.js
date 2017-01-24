(function() {

	document.addEventListener('deviceready', onDeviceReady.bind(this), false);
	
	function onDeviceReady() {

      
		var push = PushNotification.init({ "android": {"senderID": "81511517930"}});
		 push.on('registration', function(data) {
		 console.log(data.registrationId);
		 document.getElementById("gcm_id").innerHTML = data.registrationId;
		 });

		 push.on('notification', function(data) {
		 alert(data.title+" Message: " +data.message);
		 });

		 push.on('error', function(e) {
		 alert(e);
		 });
	};

})();




