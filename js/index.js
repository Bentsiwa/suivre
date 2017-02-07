(function() {

	document.addEventListener('deviceready', onDeviceReady.bind(this), false);
	
	function onDeviceReady() {

	document.getElementById("newimage").onclick = function() {
		
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





