<?php

namespace App\Helpers;

use KubAT\PhpSimple\HtmlDomParser;

use App\Helpers\Scrapers\ISO3166\CityScraper;
use App\Helpers\Scrapers\ISO3166\ProvinceScraper;
use App\Helpers\Scrapers\ISO3166\RegionScraper;use Log;

class WebScraper {

    public static function initialize($url) {
        return HtmlDomParser::file_get_html($url);
    }

    public static function scrape($source) {
        $regionUrl = $cityUrl = null;
        $cityScraper        = new CityScraper;
        $provinceScraper    = new ProvinceScraper;
        $regionScraper      = new RegionScraper;

        if(strcmp($source, config('constants.source.iso3166.name')) === 0) {
            $regionUrl = config('constants.source.iso3166.url.region');
            $cityUrl = config('constants.source.iso3166.url.city');
        }

        if($regionScraper->scrape(self::initialize($regionUrl))) {
            if($provinceScraper->scrape(self::initialize($regionUrl))) {
                return $cityScraper->scrape(self::initialize($cityUrl));
            }
        }
    }

}