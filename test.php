<?php declare(strict_types=1);

namespace WebScraper;

use Amp\Http\Client\HttpClientBuilder;
use WebScraper\Http\Client;
use function Amp\Promise\wait;

require_once __DIR__ . '/vendor/autoload.php';

$scraper = new Scraper(new Client(HttpClientBuilder::buildDefault()));

var_dump(wait($scraper->search('lagavulin')));