<?php

declare(strict_types=1);

use Rest\Romans\Action;
use Slim\App;
use Slim\Psr7\Factory\ResponseFactory;

$app = new App(new ResponseFactory());

$app->addErrorMiddleware(true, true, true);

$app->get('/', Action\Home::class);

return $app;
