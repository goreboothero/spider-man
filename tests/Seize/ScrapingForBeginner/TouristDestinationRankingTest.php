<?php

declare(strict_types=1);

namespace Goreboothero\SpiderMan\Seize\ScrapingForBeginner;

use DOMWrap\Document;
use Goreboothero\SpiderMan\DTO\TouristDestination;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class TouristDestinationRankingTest extends TestCase
{
    /** @var TouristDestinationRanking */
    protected $scrapingForBeginner;

    protected function setUp(): void
    {
        $this->scrapingForBeginner = new TouristDestinationRanking(new Client(), new Document());
    }

    public function testIsInstanceOfScrapingForBeginner(): void
    {
        $SUT = $this->scrapingForBeginner;
        $actual = $SUT->pull();

        $this->assertInstanceOf(TouristDestinationRanking::class, $SUT);
        $this->assertInstanceOf(Collection::class, $actual);
        $this->assertInstanceOf(TouristDestination::class, $actual->first());

        /** @var TouristDestination $touristDestination */
        $touristDestination = $actual->first();
        $this->assertInstanceOf(TouristDestination::class, $touristDestination);
        $this->assertIsString($touristDestination->getName());
        $this->assertIsString($touristDestination->getTotalStarRate());
    }
}
