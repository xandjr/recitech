
// Nomes dos dois caches usados nesta versão do service worker.
// Melhor versão: v2, etc. quando você atualizar qualquer um dos recursos locais,
// por sua vez, aciona o evento de instalação novamente.
const PRECACHE = 'precache-v2';
const RUNTIME = 'runtime';
//tst
// Uma lista de recursos locais que sempre queremos armazenar em cache.
const PRECACHE_URLS = [
    
      'index.html'
      
];

// O manipulador de instalação cuida do pré-caching dos recursos que sempre precisamos.
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(PRECACHE)
            .then(cache => cache.addAll(PRECACHE_URLS))
            .then(self.skipWaiting())
    );
});


// O manipulador de ativação cuida da limpeza de caches antigos.
self.addEventListener('activate', event => {
    const currentCaches = [PRECACHE, RUNTIME];
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return cacheNames.filter(cacheName => !currentCaches.includes(cacheName));
        }).then(cachesToDelete => {
            return Promise.all(cachesToDelete.map(cacheToDelete => {
                return caches.delete(cacheToDelete);
            }));
        }).then(() => self.clients.claim())
    );
});

// O manipulador ( fetch)de busca fornece respostas para recursos de mesma origem de um cache.
// Se nenhuma resposta for encontrada, ele preenche o cache de tempo de execução com a resposta
// da rede antes de retorná-lo à página.
self.addEventListener('fetch', event => {
    // Ignore solicitações de origem cruzada, como as do Google Analytics.
    if (event.request.method === "POST") {
    }
    else {
        if (event.request.url.startsWith(self.location.origin)) {
            event.respondWith(
                caches.match(event.request).then(cachedResponse => {
                    if (cachedResponse) {
                        return cachedResponse;
                    }

                    return caches.open(RUNTIME).then(cache => {
                        return fetch(event.request).then(response => {
                           // Coloca uma cópia da resposta no cache de tempo de execução.
                            return cache.put(event.request, response.clone()).then(() => {
                                return response;
                            });
                        });
                    });
                })
            );
        }
    }
});