<?php

declare(strict_types=1);

namespace Rest\Romans\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Romans\Filter\RomanToInt as RomanToIntFilter;

class Romans
{
    private ?RomanToIntFilter $romanToIntFilter;

    /**
     * @param array<string,string> $args
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        unset($request);

        $response->getBody()->write(json_encode([
            'arabic' => (string) $this->getRomanToIntFilter()->filter($args['value']),
            'roman'  => $args['value'],
        ]));

        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json');
    }

    private function getRomanToIntFilter(): RomanToIntFilter
    {
        return $this->romanToIntFilter ?? new RomanToIntFilter();
    }
}
