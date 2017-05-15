var CACHE_NAME = 'GoWestDrive-v1';
var urlsToCache = [
	'/',
	'manifest.json',
	'/index.html',
	'/terms.html',
	'/assets/css/reset.css',
	'/assets/css/screen.css',
	'/assets/js/jQueryCDN3.1.1.js',
	'/assets/js/script.js',
	'/assets/media/images/accident.jpg'
];

self.addEventListener('install', function (event) {
	//The installation will only succeed if all urlsToCache can be resolved.
	event.waitUntil(
		caches.open(CACHE_NAME)
			.then(function (cache) {
				console.log('opened cache');
				return cache.addAll(urlsToCache);
			}, function () {
				console.log('failed to load cache')
			}).then(function () {
			console.log('Caching succeeded');
		}, function () {
			console.log('Failed to cache')
		})
	);
	self.skipWaiting();
});


self.addEventListener('activate', function (event) {
	event.waitUntil(
		console.log('Activating SW')
	)
});


self.addEventListener('fetch', function (event) {
	/*
	 First try to fetch the page from the interwebz (able to connect to the server).
	 If that doesn't work, get the cached version (static pages while unable to connect to the server).
	 If all else fails, show an error page (dynamic pages while unable to connect to the server).
	 */

	console.log('Fetching...');
	event.respondWith(fetch(event.request)
		.catch(function (error) {
			return caches.open(CACHE_NAME)
				.then(function (cache) {
					return cache.match(event.request);	//TODO catch undefined
				})
		})
		.then(function (data) {
			if(data === undefined) {
				data = caches.open(CACHE_NAME)
					.then(function (cache) {
						return cache.match('index.html');
					});
			}
			return data;
		})

		/*
		.catch(function (error) {						//TODO why is this not responding to 'undefined'?
			console.log('No cached version found', error);
			return caches.open(CACHE_NAME)
				.then(function (cache) {
					return cache.match('index.html');
				})
		})
		*/
	)

	/*
	event.respondWith(fetch(event.request).catch(function (error) {
		console.log('Getting offline replacement', error);
		return caches.open(CACHE_NAME)
			.then(function (cache) {
				return cache.match('/index.html');
			})
	}))
	*/

});