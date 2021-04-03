<?php

declare(strict_types=1);

namespace Rest\Romans;

use Slim\App as BaseApp;
use Slim\Psr7\Factory\ResponseFactory;

class App extends BaseApp
{
    public function __construct()
    {
        parent::__construct(new ResponseFactory());

        $this->addErrorMiddleware(true, true, true);

        $this->get('/', Action\Home::class);
    }
}
