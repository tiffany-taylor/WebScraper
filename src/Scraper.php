<?php declare(strict_types=1);


namespace WebScraper;

use Amp\Promise;
use WebScraper\Http\Client;
use WebScraper\Retriever\SearchOnDistillerDotCom;

class Scraper
{
    private Client $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function search(string $keywords): Promise
    {
        return (new SearchOnDistillerDotCom($this->httpClient))->retrieve($keywords);
    }
}