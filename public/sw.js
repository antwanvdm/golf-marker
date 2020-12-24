self.addEventListener('install', function (event) {
    //Install events, jada jada
});

self.addEventListener('fetch', function (event) {
    let request = event.request;
    if (request.url.indexOf('api/') !== -1) {
        return;
    }
});
