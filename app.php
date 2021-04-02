<?php

declare(strict_types=1);

use Rest\Romans\Action;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->addErrorMiddleware(true, true, true);

$app->get('/', Action\Home::class);

return $app;
