<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->addErrorMiddleware(true, true, true);

return $app;
