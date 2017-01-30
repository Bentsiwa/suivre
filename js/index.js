(function() {

	document.addEventListener('deviceready', onDeviceReady.bind(this), false);
	
	function onDeviceReady() {
	// document.getElementById("indexbtn").onclick = function() {
 //      alert("here");
	// 	var push = PushNotification.init({ "android": {"senderID": "81511517930"}});
	// 	 push.on('registration', function(data) {
	// 	 var device=data.registrationId; 
	// 	 console.log(data.registrationId);
	// 	 //document.getElementById("gcm_id").innerHTML = data.registrationId;
	// 	 alert(data.registrationId);
	// 	 });

	// 	 push.on('notification', function(data) {
	// 	 alert(data.title+" Message: " +data.message);
	// 	 });

	// 	 push.on('error', function(e) {
	// 	 alert(e);
	// 	 });

	// 	}

	document.getElementById("capturePhoto").onclick = function() {
			navigator.camera.getPicture(onPhotoDataSuccess, onFail, {
				quality : 50,

				destinationType : destinationType.DATA_URL
			});
		}

	};


	function onPhotoDataSuccess(imageData) {

		var smallImage = document.getElementById('smallImage');

		smallImage.style.display = 'block';

		smallImage.src = "data:image/jpeg;base64," + imageData;

	}

	function onFail(message) {

		alert('Failed because: ' + message);

	}



})();




