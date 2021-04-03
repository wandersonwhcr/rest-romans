<?php

declare(strict_types=1);

namespace Rest\Romans\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Romans\Filter\Exception as FilterException;
use Romans\Filter\IntToRoman as IntToRomanFilter;

class Arabics
{
    private ?IntToRomanFilter $intToRomanFilter;

    /**
     * @param array<string,string> $args
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        unset($request);

        try {
            $status  = 200;
            $content = [
                'arabic' => $args['value'],
                'roman'  => $this->getIntToRomanFilter()->filter((int) $args['value']),
            ];
        } catch (FilterException $e) {
            $status  = 422;
            $content = [
                'code'    => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }

        $response->getBody()->write(json_encode($content));

        return $response->withStatus($status)
            ->withHeader('Content-Type', 'application/json');
    }

    private function getIntToRomanFilter(): IntToRomanFilter
    {
        return $this->intToRomanFilter ??= new IntToRomanFilter();
    }
}
