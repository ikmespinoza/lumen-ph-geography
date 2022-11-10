<?php

namespace App\Helpers\Scrapers\ISO3166;

use App\Helpers\StringHelper;

use App\Models\Province;
use App\Models\Region;

use App\Traits\HistoryTrait;
use App\Traits\SanitizerTrait;

class ProvinceScraper {

    use HistoryTrait, SanitizerTrait;

    public function scrape($dom) {
        // If not modified, no need to proceed creating region information
        if(!$this->isModified(Province::class, $this->sanitize($dom->find('#footer-info-lastmod', 0)))) {
            return true;
        }

        try {
            $provinces = $dom->find('#Provinces', 0);

            if(!empty($provinces)) {
                $table = $provinces->parent();

                while(strcmp($table->tag, 'table') !== 0) {
                    $table = $table->next_sibling();
                }

                $trs    = $table->find('tr');

                // Traverse through the provinces table
                foreach ($trs as $tr => $element) {
                    // Proceed if current row is not equal to the first row
                    if($tr !== array_key_first($trs)) {
                        $code       = $this->sanitize($element->childNodes(0)->innertext);
                        $region     = $this->sanitize($element->childNodes(3)->innertext);
                        $tempName   = $this->sanitize($element->childNodes(1)->innertext);
    
                        // Retrieve region information
                        $region = Region::where('code', "PH-{$region}")->first();
    
                        if($region) {
                            // Check if province already exist on the database, proceed if not
                            if(!Province::where('code', $code)->first()) {
                                Province::create([
                                    'code'      => $code,
                                    'name'      => StringHelper::stripAltName($tempName),
                                    'alt_name'  => StringHelper::getAltName($tempName),
                                    'name_tl'   => $this->sanitize($element->childNodes(2)->innertext),
                                    'region_id' => $region->id,
                                ]);
                            }
                        }
                    }
                }
            }

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

}