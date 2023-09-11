function initialize() {

	//Exibir mapa;
	var myLatlng = new google.maps.LatLng(-22.213169, -49.6524262);
	var mapOptions = {
		zoom: 17,
		center: myLatlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}

	//Exibir o mapa na div #mapa;
	var map = new google.maps.Map(document.getElementById("mapa"), mapOptions);
}

// Função para carregamento assíncrono
  function loadScript() {
  var script = document.createElement("script");
  script.type = "text/javascript";
  script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyBCVQLEevOAO81HhpFj8AQOmq6ET2Hp7Uw&callback=initialize";

  document.body.appendChild(script);
}

  window.onload = loadScript;

//chave AIzaSyBCVQLEevOAO81HhpFj8AQOmq6ET2Hp7Uw