// Mapa
var map, infoWindow;
function initMap() {
  var mapOptions = {
      zoom: 15,
      mapTypeId:  'roadmap', // roadmap, satellite, hybrid, terrain
      styles: [
        {
          "elementType": "geometry",
          "stylers": [
            {
              "color": "#242f3e"
            }
          ]
        },
        {
          "elementType": "labels.text.fill",
          "stylers": [
            {
              "color": "#746855"
            }
          ]
        },
        {
          "elementType": "labels.text.stroke",
          "stylers": [
            {
              "color": "#242f3e"
            }
          ]
        },
        {
          "featureType": "administrative.locality",
          "elementType": "labels.text.fill",
          "stylers": [
            {
              "color": "#d59563"
            }
          ]
        },
        {
          "featureType": "poi",
          "elementType": "poi",
          "stylers": [
            {
              "visibility": "off"
            }
          ]
        },
        {
          "featureType": "poi",
          "elementType": "labels.text.fill",
          "stylers": [
            {
              "color": "#d59563"
            }
          ]
        },
        {
          "featureType": "poi.park",
          "elementType": "geometry",
          "stylers": [
            {
              "color": "#263c3f"
            }
          ]
        },
        {
          "featureType": "poi.park",
          "elementType": "labels.text.fill",
          "stylers": [
            {
              "color": "#6b9a76"
            }
          ]
        },
        {
          "featureType": "road",
          "elementType": "geometry",
          "stylers": [
            {
              "color": "#38414e"
            }
          ]
        },
        {
          "featureType": "road",
          "elementType": "geometry.stroke",
          "stylers": [
            {
              "color": "#212a37"
            }
          ]
        },
        {
          "featureType": "road",
          "elementType": "labels.text.fill",
          "stylers": [
            {
              "color": "#9ca5b3"
            }
          ]
        },
        {
          "featureType": "road.highway",
          "elementType": "geometry",
          "stylers": [
            {
              "color": "#746855"
            }
          ]
        },
        {
          "featureType": "road.highway",
          "elementType": "geometry.stroke",
          "stylers": [
            {
              "color": "#1f2835"
            }
          ]
        },
        {
          "featureType": "road.highway",
          "elementType": "labels.text.fill",
          "stylers": [
            {
              "color": "#f3d19c"
            }
          ]
        },
        {
          "featureType": "transit",
          "elementType": "geometry",
          "stylers": [
            {
              "color": "#2f3948"
            }
          ]
        },
        {
          "featureType": "transit.station",
          "elementType": "labels.text.fill",
          "stylers": [
            {
              "color": "#d59563"
            }
          ]
        },
        {
          "featureType": "water",
          "elementType": "geometry",
          "stylers": [
            {
              "color": "#17263c"
            }
          ]
        },
        {
          "featureType": "water",
          "elementType": "labels.text.fill",
          "stylers": [
            {
              "color": "#515c6d"
            }
          ]
        },
        {
          "featureType": "water",
          "elementType": "labels.text.stroke",
          "stylers": [
            {
              "color": "#17263c"
            }
          ]
        }
      ],
      zoomControl: false,
      fullscreenControl: false,
      mapTypeControl: false,
  };
  map = new google.maps.Map(document.getElementById('map'), mapOptions);

  // Função de geolocalização
  navigator.geolocation.watchPosition(function(position) {
    var userLocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
    };

    // Usado para deixar o mapa centrado na posição do usuário
    map.setCenter(userLocation);

    // Adiciona um marcador na localização do usuário
    var userMarker = new google.maps.Marker({
        position: userLocation,
        map: map,
        title: 'Sua localização',
        icon: "imagens/ponto.png"
    });
  }, function(error) {
      // Erro caso ocorra algum problema ao conseguir a localização
      console.error('Erro ao obter a localização: ', error);
  });

// Adicionar marcadores
  var pontos = [
    {
      position: {lat: -5.829399640990832,  lng: -35.20889289176802},
      map: map,
      title: 'Evs Reciclagem Digital E Informatica',
      // label: 'P',
      // icon: "imagens/ponto.png"
      // animation: google.maps.Animation.DROP
    },
    {
      position: {lat: -5.78402942496059, lng: -35.20212468608085},
      map: map,
      title: 'EcoPonto de Coleta de Lâmpadas e Pilhas',
    },
    {
      position: {lat: -5.841683114654219, lng: -35.21192824867318},
      map: map,
      title: 'Ecoponto Natal Shopping',
    },
    {
      position: {lat: -5.864398849783733, lng: -35.18549817449187},
      map: map,
      title: 'Ecoponto de Lixo Eletrônico Do Praia Shopping',
    },
    {
      position: {lat: -5.826028059860113, lng: -35.23472020388516},
      map: map,
      title: 'Natal Reciclagem',
    }
  ];
  pontos.forEach(function(ponto) {
    var marker = new google.maps.Marker({
        position: ponto.position,
        map: map,
        title: ponto.title,
        label: ponto.label,
        animation: ponto.animation
    });

    marker.addListener('click', function() {
      // Exibe informações sobre o local
      var infoWindow = new google.maps.InfoWindow({
          content: '<h3>' + ponto.title + '</h3>' +
          '<p>Infos</p>'
      });
      infoWindow.open(map, marker);
    });
  });
  // Remover marcadores
  // marker.setMap(null);
  
  // map.mapTypes.set('meumapa', new MeuMapa(new google.maps.Size(256,256)));
  // Botão de centralizar
  infoWindow = new google.maps.InfoWindow();
  const locationButton = document.createElement('button');
  locationButton.textContent = "Centralizar";
  locationButton.classList.add("custom-map-control-button");

  map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

  locationButton.addEventListener("click", () => {
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };
        },
        () => {
          handleLocationError(true, infoWindow, map.getCenter());
        }
      );
    } else {
      // Browser doesn't support Geolocation
      console.log('Navegador não suporta.');
    }
  });
}
window.initMap = initMap;