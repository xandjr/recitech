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

  var userMarker = null; // Variável para armazenar o marcador do usuário
  var userLocation;
  var directionsService = new google.maps.DirectionsService();

  // Função de geolocalização
  navigator.geolocation.watchPosition(function(position) {
    userLocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
    };

    // Remove o marcador anterior, se existir
    if (userMarker) {
      userMarker.setMap(null);
    }
    // Define o tamanho do ícone (por exemplo, 32x32 pixels)
    var iconSize = new google.maps.Size(32, 32);
    // Adiciona um novo marcador na posição atualizada
    userMarker = new google.maps.Marker({
      position: userLocation,
      map: map,
      title: 'Sua localização',
      icon: {
        url: "imagens/ponto.png",
        scaledSize: iconSize,
      }
    });

    // Usado para deixar o mapa centrado na posição do usuário
    map.setCenter(userLocation);

  }, function(error) {
      // Erro caso ocorra algum problema ao conseguir a localização
      console.error('Erro ao obter a localização: ', error);
  });

  // Adicionar marcadores
  var pontos = [
    {
      position: {lat: -5.831458321891048,  lng: -35.20815277387228},
      map: map,
      title: 'Evs Reciclagem Digital E Informatica',
      endereco: 'R. da Esmeralda, 28 - Lagoa Nova, Natal - RN, 59076-590',
      // label: 'P',
      // animation: google.maps.Animation.DROP
    },
    {
      position: {lat: -5.793289059201903, lng: -35.20353832567897}, 
      map: map,
      title: 'EcoPonto de Coleta de Lâmpadas e Pilhas',
      endereco: 'Av. Prudente de Morais, 9398 - Tirol, Natal - RN, 59065-500',
    },
    {
      position: {lat: -5.8428272519908315, lng: -35.21196745014775},
      map: map,
      title: 'Ecoponto Natal Shopping',
      endereco: 'Candelária, Natal - RN, 59064-720',
    },
    {
      position: {lat: -5.866678036928719, lng: -35.18579865981596},
      map: map,
      title: 'Ecoponto de Lixo Eletrônico Do Praia Shopping',
      endereco: 'Praia Shopping, Av. Praia de Genipabú - Ponta Negra, RN',
    },
    {
      position: {lat: -5.826566418378347, lng: -35.23465840660466},
      map: map,
      title: 'Natal Reciclagem',
      endereco: 'R. Adolfo Gordo, 2279 - Cidade da Esperança, Natal - RN, 59070-100',
    }
  ];
  // Crie uma janela de informações com o conteúdo desejado (por exemplo, o endereço)
  var infoWindow = new google.maps.InfoWindow();

  // Crie um objeto DirectionsRenderer para exibir a rota no mapa
  var directionsDisplay = new google.maps.DirectionsRenderer();

  // Associe a janela de informações a cada marcador
  pontos.forEach(function(ponto) {
    var marker = new google.maps.Marker({
        position: ponto.position,
        map: map,
        title: ponto.title
    });

    // Quando o marcador é clicado, exiba a janela de informações
    marker.addListener('click', function() {
        infoWindow.setContent(
          '<h3>' + ponto.title + '</h3>' +
          '<p>' + ponto.endereco + '</p>',
          // '<button onclick="calcularRota(' + ponto.position.lat + ', ' + ponto.position.lng + ')">Traçar Rota</button>'
        );
        infoWindow.open(map, marker);
      var request = {
        origin: userLocation, // Substitua pela localização real do usuário
        destination: ponto.position, // Destino é o ponto específico clicado
        travelMode: google.maps.DirectionsTravelMode.DRIVING // Modo de viagem (DRIVING, WALKING, etc.)
      };
      // Calcule a rota
      directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            // Exiba a rota no mapa
            directionsDisplay.setDirections(response);
            directionsDisplay.setMap(map);
        } else {
            console.error('Erro ao calcular a rota:', status);
        }
      });
    });
  });
  // function calcularRota(destinoLat, destinoLng){
  //   // Crie uma solicitação de rota
  //   var request = {
  //     origin: userLocation, // Substitua pela localização real do usuário
  //     destination: { lat: destinoLat, lng: destinoLng }, // Destino é o ponto específico clicado
  //     travelMode: google.maps.DirectionsTravelMode.DRIVING // Modo de viagem (DRIVING, WALKING, etc.)
  //   };
  //   // Calcule a rota
  //   directionsService.route(request, function(response, status) {
  //     if (status == google.maps.DirectionsStatus.OK) {
  //         // Exiba a rota no mapa
  //         directionsDisplay.setDirections(response);
  //         directionsDisplay.setMap(map);
  //     } else {
  //         console.error('Erro ao calcular a rota:', status);
  //     }
  //   });
  // };

  // Remover marcadores
  // marker.setMap(null);
  
  // // Botão de centralizar
  // infoWindow = new google.maps.InfoWindow();
  // const locationButton = document.createElement('button');
  // locationButton.textContent = "Centralizar";
  // locationButton.classList.add("custom-map-control-button");

  // map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

  // locationButton.addEventListener("click", () => {
  //   // Try HTML5 geolocation.
  //   if (navigator.geolocation) {
  //     navigator.geolocation.getCurrentPosition(
  //       (position) => {
  //         const pos = {
  //           lat: position.coords.latitude,
  //           lng: position.coords.longitude,
  //         };
  //       },
  //       () => {
  //         handleLocationError(true, infoWindow, map.getCenter());
  //       }
  //     );
  //   } else {
  //     // Browser doesn't support Geolocation
  //     console.log('Navegador não suporta.');
  //   }
  // });
}
window.initMap = initMap;