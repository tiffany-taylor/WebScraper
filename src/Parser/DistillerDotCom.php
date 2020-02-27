<?php declare(strict_types=1);


namespace WebScraper\Parser;


use function Room11\DOMUtils\xpath_html_class;

class DistillerDotCom
{
    public function parse(\DOMDocument $dom)
    {
        $xpath = new \DOMXPath($dom);

        if (!$this->isBoozeFound($xpath)) {
            return null;
        }
        return 'found';
    }

    private function isBoozeFound(\DOMXPath $xpath): bool
    {
        return (bool) $xpath->evaluate('//ol['.xpath_html_class('spirits').']/li['.xpath_html_class('spirit').']')->length;
    }
}