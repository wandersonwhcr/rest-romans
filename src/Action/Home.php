<?php

declare(strict_types=1);

namespace Rest\Romans\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;

class Home
{
    /**
     * @param array<string,string> $args
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        unset($request, $args);

        $response->getBody()->write(json_encode([
            'name' => 'romans',
        ]));

        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json');
    }
}
