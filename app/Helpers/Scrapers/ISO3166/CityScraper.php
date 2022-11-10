<?php

namespace App\Helpers\Scrapers\ISO3166;

use Illuminate\Support\Str;

use App\Helpers\StringHelper;

use App\Models\City;
use App\Models\Classification;
use App\Models\Province;

use App\Traits\HistoryTrait;
use App\Traits\SanitizerTrait;use Log;

class CityScraper {

    use HistoryTrait, SanitizerTrait;

    public function scrape($dom) {
        try {
            $provinces = $dom->find('#List', 0);

            if(!empty($provinces)) {
                $table  = $provinces->parent();

                while(strcmp($table->tag, 'table') !== 0) {
                    $table = $table->next_sibling();
                }

                $trs    = $table->find('tr');

                // Traverse through the cities table
                foreach ($trs as $tr => $element) {
                    // Proceed if current row is not equal to the first and last rows
                    if($tr !== array_key_first($trs) && $tr !== array_key_last($trs)) {
                        $tempName       = $this->sanitize($element->childNodes(0)->innertext);
                        $name           = StringHelper::stripAltName($tempName);
                        $altName        = StringHelper::getAltName($tempName);
                        $provinceName   = $this->sanitizeProvinceName($element->childNodes(6)->innertext);
                        $province       = $this->getProvince($provinceName);
                        $classification = $this->getClassification($element->childNodes(5)->innertext);
    
                        // If province record exists, proceed
                        if($province) {
                            $city = array(
                                'name'              => StringHelper::stripAltName($tempName),
                                'alt_name'          => StringHelper::getAltName($tempName),
                                'full_name'         => $this->getCityFullName($name, $classification),
                                'is_capital'        => $this->isCapital($element->childNodes(0)->attr),
                                'province_id'       => $province ? $province->id : null,
                                'classification_id' => $classification ? $classification->id : null,
                            );

                            // Check if city already exist on the database, proceed if not
                            if(!$this->exists($city)) {
                                City::create($city);
                            }
                        }
                    }
                }
            }

            return true;
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    // Check if city already exists on the database
    private function exists($city) {
        return City::where('name', $city['name'])
                    ->where('alt_name', $city['alt_name'])
                    ->where('full_name', $city['full_name'])
                    ->where('is_capital', $city['is_capital'])
                    ->where('province_id', $city['province_id'])
                    ->where('classification_id', $city['classification_id'])
                    ->first();
    }

    // Get full name of the city
    private function getCityFullName($name, $classification) {
        if(!in_array($classification->code, array_keys(config('constants.classifications.city')))) {
            return $name;
        }

        if(!str_starts_with($name, 'City ') && !str_ends_with($name, ' City')) {
            return "{$name} City";
        }

        return $name;
    }

    // Get classification information
    private function getClassification($code) {
        return Classification::where('code', $code)->first();
    }

    // Get province information
    private function getProvince($string) {
        $province = Province::where('name', $string)
                            ->orWhere('alt_name', $string)
                            ->first();

        if(!$province) {
            if(!str_starts_with($string, 'NCR')) {
                throw new \Exception("Could not find province {$string}.");
            }

            return null;
        }

        return $province;
    }

    // Determine if it's a provincial capital
    private function isCapital($attr) {
        if(isset($attr['style']) && $attr['style']) {
            return Str::contains($attr['style'], 'border-width');
        }

        return false;
    }

}