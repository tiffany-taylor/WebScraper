<?php declare(strict_types=1);


namespace WebScraper\Retriever;

use Amp\Promise;
use WebScraper\Http\Client;
use WebScraper\Parser\DistillerDotCom;
use function Amp\call;

class SearchOnDistillerDotCom
{
    private Client $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function retrieve(string $command): Promise
    {
        return call(function () use ($command) {
            $dom = yield $this->httpClient->requestHtml(
                sprintf('https://distiller.com/search?term=%s', urlencode($command)),
            );

            return (new DistillerDotCom())->parse($dom);
        });
    }
}