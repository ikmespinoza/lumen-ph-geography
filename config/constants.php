<?php

return [
    'classifications' => array(
        'city' => array(
            'CC' => 'Component City',
            'ICC' => 'Independent Component City',
            'HUC' => 'Highly Urbanized City',
        ),
        'municipality' => array(
            'Mun' => 'Municipality'
        )
    ),
    'omit' => array (
        'modified_at' => 'This page was last edited on ',
        // 'at' => ', at',
        'utc' => '(UTC).',
    ),
    'source' => array(
        'iso3166' => array(
            'name' => 'ISO 3166',
            'url' => array(
                'region' => 'https://en.wikipedia.org/wiki/ISO_3166-2:PH',
                'city' => 'https://en.wikipedia.org/wiki/List_of_cities_and_municipalities_in_the_Philippines',
            ),
        ),
    ),
];
