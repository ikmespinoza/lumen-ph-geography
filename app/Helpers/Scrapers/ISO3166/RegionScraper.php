<?php

namespace App\Helpers\Scrapers\ISO3166;

use App\Helpers\StringHelper;

use App\Models\History;
use App\Models\Region;

use App\Traits\HistoryTrait;
use App\Traits\SanitizerTrait;

class RegionScraper {

    use HistoryTrait, SanitizerTrait;

    public function scrape($dom) {
        // If not modified, no need to proceed creating region information
        if(!$this->isModified(Region::class, $this->sanitize($dom->find('#footer-info-lastmod', 0)))) {
            return true;
        }

        try {
            $regions = $dom->find('#Regions', 0);

            if(!empty($regions)) {
                $table = $regions->parent();

                while(strcmp($table->tag, 'table') !== 0) {
                    $table = $table->next_sibling();
                }

                $trs    = $table->find('tr');

                // Traverse through the provinces table
                foreach ($trs as $tr => $element) {
                    // Proceed if current row is not equal to the first row
                    if($tr !== array_key_first($trs)) {
                        $code = $this->sanitize($element->childNodes(0)->innertext);
    
                        // Check if region already exist on the database, proceed if not
                        if(!Region::where('code', $code)->first()) {
                            Region::create([
                                'code'      => $code,
                                'name'      => $this->sanitize($element->childNodes(1)->innertext),
                                'name_tl'   => $this->sanitize($element->childNodes(2)->innertext),
                                'acronym'   => $this->sanitize($element->childNodes(3)->innertext),
                            ]);
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