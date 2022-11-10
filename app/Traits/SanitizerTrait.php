<?php

namespace App\Traits;

use App\Helpers\StringHelper; 

trait SanitizerTrait {

    private function sanitize($string) {
        return StringHelper::stripAnnotation(trim($string));
    }

    private function sanitizeProvinceName($string) {
        $provinceName = $this->sanitize($string);
        $provinceName = (strcmp($provinceName, 'Occidental Mindoro') === 0) ? 'Mindoro Occidental' : $provinceName;
        $provinceName = (strcmp($provinceName, 'Oriental Mindoro') === 0) ? 'Mindoro Oriental' : $provinceName;

        return $provinceName;
    }

}