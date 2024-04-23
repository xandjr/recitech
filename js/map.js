// //Mapa
// class MeuMapa {
//   constructor(tileSize){
//     this.tileSize = tileSize;
//     this.maxZoom = 10;
//     this.name = 'Meu Mapa';
//     this.alt = 'O mapa não carregou';
//   }
//   getTile(coord, zoom, ownerDocument){
//     var div = ownerDocument.createElement('div');
//     div.style.height = this.tileSize.height+'px';
//     div.style.width = this.tileSize.width+'px';
//     div.style.fontSize = '10px';
//     div.style.borderStyle = 'solid';
//     div.style.borderWidth = '1px';
//     div.style.borderColor = '#333';
//     return div;
//   }
// }
var map, infoWindow;
function initMap() {
  var mapOptions = {
      center: {lat: -5.777221144298522, lng: -35.25227316285317},
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
// Adicionar marcadores
  var marker = new google.maps.Marker({
    position: {lat: -5.777221144298522, lng: -35.25227316285317},
    map: map,
    title: 'Ponto de Coleta',
    label: 'P',
    // icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'
    animation: google.maps.Animation.DROP
  });

// Remover marcadores
  // marker.setMap(null);
  
//   map.mapTypes.set('meumapa', new MeuMapa(new google.maps.Size(256,256)));
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

          infoWindow.setPosition(pos);
        infoWindow.setContent("Aqui está você.");
          infoWindow.open(map);
          map.setCenter(pos);
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
