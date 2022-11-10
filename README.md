# lumen-ph-geography
Simple REST API implemented using [Laravel Lumen](https://github.com/laravel/lumen). A project inspired from [hyubs/ph-locations](https://github.com/hyubs/ph-locations) by [Hyubs](https://github.com/hyubs).

#### Table of contents
- [About](#about)
- [Sources](#sources)
    - [ISO 3166 & Wikipedia](#iso-3166--wikipedia)
- [Requirements](#requirements)
- [Usage](#usage)
    - [Installation Instructions](#installation-instructions)
    - [Routes](#routes)
- [Properties](#properties)
    - [Regions](#regions)
    - [Provinces](#provinces)
    - [Cities and Municipalities](#cities-and-municipalities)
    - [Classifications](#classifications)
- [License](#license)

## About
Provides a library of locations in the Philippines (regions, provinces, and cities/municipalities) that can automatically check the source, ensuring the data is always updated

## Sources
### ISO 3166 & Wikipedia
* [ISO 3166-2:PH](https://en.wikipedia.org/wiki/ISO_3166-2:PH)
* [List of cities and municipalities in the Philippines](https://en.wikipedia.org/wiki/List_of_cities_and_municipalities_in_the_Philippines)

## Requirements
PHP 7.3 and later.

## Usage
### Installation Instructions
1. Run `git clone https://github.com/ikmespinoza/lumen-ph-geography.git`.
2. Create a MySQL database for the project:
    * ```mysql -u root -p```, if using Vagrant: ```mysql -u <username> -p <password>```
    * ```create database <database-name>;```
    * ```\q```
3. From the projects root run `cp .env.example .env`.
4. Configure your `.env` file.
5. Run `composer update` from the projects root folder.
6. From the projects root folder run `composer dump-autoload`.
7. From the projects root folder run `php artisan db:seed`.

### Routes
```bash
+------+----------------------------------------------------------+--------------------------------+-----------------------------------------+---------+------------+
| Verb | Path                                                     | NamedRoute                     | Controller                              | Action  | Middleware |
+------+----------------------------------------------------------+--------------------------------+-----------------------------------------+---------+------------+
| GET  | /api/regions                                             | regions.index                  | App\Http\Controllers\RegionController   | index   |            |
| GET  | /api/regions/{region}                                    | regions.show                   | App\Http\Controllers\RegionController   | show    |            |
| GET  | /api/regions/{region}/provinces                          | regions.provinces.index        | App\Http\Controllers\ProvinceController | index   |            |
| GET  | /api/regions/{region}/provinces/{province}               | regions.provinces.show         | App\Http\Controllers\ProvinceController | show    |            |
| GET  | /api/regions/{region}/provinces/{province}/cities        | regions.provinces.cities.index | App\Http\Controllers\CityController     | index   |            |
| GET  | /api/regions/{region}/provinces/{province}/cities/{city} | regions.provinces.cities.show  | App\Http\Controllers\CityController     | show    |            |
+------+----------------------------------------------------------+--------------------------------+-----------------------------------------+---------+------------+
```

## Properties
### Regions
| Property | Description | ISO 3166 | 
| - | - | :-: |
| code | ISO 3166 | ✓ | 
| name | English name | ✓ |
| name_tl | Tagalog name | ✓ |
| acronym | Acronym, often the roman number or acronym of the region | ✓ |
| provinces | Provinces in the region | ✓ |

**ISO 3166**
```json
{
  "code": "PH-13",
  "name": "Caraga",
  "name_tl": "Rehiyon ng Karaga",
  "acronym": "XIII",
  "provinces": [
      {
          "code": "PH-AGN",
          "name": "Agusan del Norte",
          "alt_name": null,
          "name_tl": "Hilagang Agusan",
      },
      {
          "code": "PH-AGS",
          "name": "Agusan del Sur",
          "alt_name": null,
          "name_tl": "Timog Agusan",
      },
      {
          "code": "PH-DIN",
          "name": "Dinagat Islands",
          "alt_name": null,
          "name_tl": "Pulo ng Dinagat"
      },
      ...
  ]
}
```

### Provinces
| Property | Description | ISO 3166 |
| - | - | :-: |
| code | ISO 3166 | ✓ |
| name | English name | ✓ |
| alt_name | Alternative name, often its former name | ✓ |
| name_tl | Tagalog name | ✓ |
| region | ISO 3166 of the province's region | ✓ |
| cities | Cities/Municipalities in the province | ✓ |

**ISO 3166**
```json
{
  "code": "PH-AGN",
  "name": "Agusan del Norte",
  "alt_name": null,
  "name_tl": "Hilagang Agusan",
  "region": {
      "code": "PH-13",
      "name": "Caraga",
      "name_tl": "Rehiyon ng Karaga",
      "acronym": "XIII"
  },
  "cities": [
      {
          "name": "Buenavista",
          "alt_name": null,
          "full_name": "Buenavista",
          "is_capital": false,
          "classification": {
              "code": "Mun",
              "description": "Municipality"
          }
      },
      {
          "name": "Butuan",
          "alt_name": null,
          "full_name": "Butuan City",
          "is_capital": false,
          "classification": {
              "code": "HUC",
              "description": "Highly Urbanized City"
          }
      },
      {
          "name": "Cabadbaran",
          "alt_name": null,
          "full_name": "Cabadbaran City",
          "is_capital": true,
          "classification": {
              "code": "CC",
              "description": "Component City"
          }
      },
      ...
}
```

### Cities and Municipalities
| Property | Description | ISO 3166 |
| - | - | :-: |
| name | Name | ✓ |
| alt_name | Alternative name, often its former name | ✓ |
| full_name | Complete name. For ISO 3166, all cities will have names end with "City". | ✓ |
| is_capital | Is the city or municipality the capital of the province | ✓ |
| classification | Classification of the city or municipality ([see below](#classification)) | ✓ |
| province | ISO 3166 of the city's or municipality's province | ✓ |

**ISO 3166**
```json
{
  "name": "Bislig",
  "alt_name": null,
  "full_name": "Bislig City",
  "is_capital": false,
  "classification": {
      "code": "CC",
      "description": "Component City"
  },
  "province": {
      "code": "PH-SUR",
      "name": "Surigao del Sur",
      "alt_name": null,
      "name_tl": "Timog Surigaw"
  }
}
```

### Classifications
**ISO 3166**
| Value | Description |
| - | - |
| Mun | Municipality |
| CC | Component city |
| ICC | Independent component city |
| HUC | Highly urbanized city |

## License
Licensed under the [MIT License](https://opensource.org/licenses/MIT).