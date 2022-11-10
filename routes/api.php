<?php

use App\Helpers\WebScraper;
/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('test', function() {
    return WebScraper::scrape('ISO 3166');

    // $modified_at = 'This page was last edited on 8 August 2021, at 07:15';
    // $modified_at = str_replace(config('constants.omit.modified_at'), '', $modified_at);

    // return  \Carbon\Carbon::parse($modified_at);
});

$router->group(['prefix' => 'api'], function() use ($router) {

    $router->group([
            'as' => 'regions', 'prefix' => 'regions'
        ], function($router) {

        $router->get('/', [
            'as' => 'index', 'uses' => 'RegionController@index'
        ]);

        $router->get('{region}', [
            'as' => 'show', 'uses' => 'RegionController@show'
        ]);

        $router->group([
                'as' => 'provinces', 'prefix' => '{region}/provinces'
            ], function($router) {

            $router->get('/', [
                'as' => 'index', 'uses' => 'ProvinceController@index'
            ]);
    
            $router->get('{province}', [
                'as' => 'show', 'uses' => 'ProvinceController@show'
            ]);

            $router->group([
                    'as' => 'cities', 'prefix' => '{province}/cities'
                ], function($router) {

                $router->get('/', [
                    'as' => 'index', 'uses' => 'CityController@index'
                ]);

                $router->get('{city}', [
                    'as' => 'show', 'uses' => 'CityController@show'
                ]);
    
            });

        });

    });

});