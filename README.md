# Golf Marker

Awesome Web App using Tailwind CSS, Mapbox GL and a custom PHP API. It's a very simple concept to present an interface which you can find buddies for your golf exercise.
You can find a live demo on: [golf-marker.antwan.eu](https://golf-marker.antwan.eu)

## Getting started

To get started, you need:
- A mapbox GL account to get an access token;
- A sendgrid account to get an API key;
- 2 config files;
  - /src/js/application.config.js
  - /settings.php
```javascript
export default {
    apiURL: "",
    mapBoxAccessToken: ""
}
```
```php
<?php
//Define DB credentials
const DB_HOST = "";
const DB_USER = "";
const DB_PASS = "";
const DB_NAME = "";

const INCLUDES_PATH = __DIR__ . "/public/api/";
const EMAIL_FROM = "";
const SENDGRID_API_KEY = "";

```
- Server running for the PHP API side (double check this, else API will fail);
- Make sure you have a MYSQL Database (need in settings.php) and import the `_resources/sql` file;
- Run `npm install` & `composer install` (in the public/api folder);
- Run `npm run build:dev` (or watch to watch) to get a compiled JS file;
- Run `npm run serve` to get localhost up & running.
