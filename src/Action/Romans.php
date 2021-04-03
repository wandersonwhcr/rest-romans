<?php

declare(strict_types=1);

namespace Rest\Romans\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Romans\Filter\RomanToInt as RomanToIntFilter;
use Romans\Lexer\Exception as LexerException;
use Romans\Parser\Exception as ParserException;

class Romans
{
    private ?RomanToIntFilter $romanToIntFilter;

    /**
     * @param array<string,string> $args
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        unset($request);

        try {
            $status  = 200;
            $content = [
                'arabic' => (string) $this->getRomanToIntFilter()->filter($args['value']),
                'roman'  => $args['value'],
            ];
        } catch (LexerException|ParserException $e) {
            $status  = 422;
            $content = [
                'message' => $e->getMessage(),
            ];
        }

        $response->getBody()->write(json_encode($content));

        return $response->withStatus($status)
            ->withHeader('Content-Type', 'application/json');
    }

    private function getRomanToIntFilter(): RomanToIntFilter
    {
        return $this->romanToIntFilter ??= new RomanToIntFilter();
    }
}
