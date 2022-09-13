<?php

namespace App\Spiders;

use Generator;
use Str;
use Symfony\Component\DomCrawler\Crawler;
use RoachPHP\Downloader\Middleware\RequestDeduplicationMiddleware;
use RoachPHP\Extensions\LoggerExtension;
use RoachPHP\Extensions\StatsCollectorExtension;
use RoachPHP\Http\Response;
use RoachPHP\Spider\BasicSpider;
use RoachPHP\Spider\ParseResult;

class RunnerCardMeetEventSpider extends BasicSpider
{
    public array $startUrls = [
        'https://results.runnercard.com/Results/listFrame.jsp?meetid=1003923'
    ];

    public array $downloaderMiddleware = [
        RequestDeduplicationMiddleware::class,
    ];

    public array $spiderMiddleware = [
        //
    ];

    public array $itemProcessors = [
        //
    ];

    public array $extensions = [
        LoggerExtension::class,
        StatsCollectorExtension::class,
    ];

    public int $concurrency = 2;

    public int $requestDelay = 1;

    /**
     * @return Generator<ParseResult>
     */
    public function parse(Response $response): Generator
    {
        $dict = [];

        $crawler = $response->filter('a[class*="list"][target="resultFrame"]')->reduce(function (Crawler $node, $i) {
            return Str::length($node->attr('id')) > 3;
        });

        foreach ($crawler as $elem) {
            $href = $elem->getAttribute('href');
            parse_str(Str::afterLast($href, '?'), $outputs);

            $dict[$elem->nodeValue] = $outputs['event'];
        }

        yield $this->item($dict);
    }
}
