<?php

/*
|--------------------------------------------------------------------------
| Vercel Integration
|--------------------------------------------------------------------------
|
| Unfortunately, Vercel only allows an app’s entry-point to live inside the
| public directory. So, we’ll need to redirect any requests to the
| /api/index.php route to the /public/index.php entry-point.
|
*/

require_once __DIR__.'/../public/index.php';
