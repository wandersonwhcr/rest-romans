<?php

declare(strict_types=1);

namespace Rest\Romans\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Romans\Filter\IntToRoman as IntToRomanFilter;

class Arabics
{
    private ?IntToRomanFilter $intToRomanFilter;

    /**
     * @param array<string,string> $args
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        unset($request, $args);

        $response->getBody()->write(json_encode([
            'arabic' => '1999',
            'roman'  => $this->getIntToRomanFilter()->filter(1999),
        ]));

        return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json');
    }

    private function getIntToRomanFilter(): IntToRomanFilter
    {
        return $this->intToRomanFilter ?? new IntToRomanFilter();
    }
}
