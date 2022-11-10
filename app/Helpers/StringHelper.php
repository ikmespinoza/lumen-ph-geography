<?php

namespace App\Helpers;

class StringHelper {

    public static function getAltName($string) {
        if(!preg_match('/\s\([A-Za-z0-9\s]+\)$/', $string)) {
            return null;
        }

        preg_match_all('/\(([^\)]+)\)/', $string, $alt);

        return trim(end($alt[1]));
    }

    public static function stripAltName($string) {
        return trim(preg_replace('/\s\([A-Za-z0-9\s]+\)$/', '', $string));
    }

    public static function stripAnnotation($string) {
        return trim(preg_replace('/\[[^\]]*\]/', '', strip_tags(html_entity_decode($string))));
    }

}