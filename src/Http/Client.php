<?php declare(strict_types=1);

namespace WebScraper\Http;

use Amp\Http\Client\HttpClient;
use Amp\Http\Client\Request;
use Amp\Http\Client\Response;
use Amp\Promise;
use function Amp\call;
use function Room11\DOMUtils\domdocument_load_html;


class Client
{
    private HttpClient $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function makeRequest(Request $request): Promise
    {
        return call(function() use ($request) {
            $response = yield $this->httpClient->request($request);
            if ($response->getStatus() !== 200) {
                throw new \Exception("Network error");
            }
            return $response;
        });
    }

    public function requestHtml(string $uri): Promise
    {
        return call(function () use ($uri) {
            $request = new Request($uri);

            $response = yield $this->makeRequest($request);

            //var_dump(yield $response->getBody()->buffer());die;
            return domdocument_load_html(yield $response->getBody()->buffer());
        });
    }
}