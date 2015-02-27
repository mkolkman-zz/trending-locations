<?php
namespace tests\unit\Geonames;

use App\TrendingLocations\Geonames\GeonamesImporter;

class GeonamesImporterTest /*extends \TestCase */{

    public function testGeonamesGetCorrectlyImported() {
        //Given
        /* @var GeonamesImporter $importer*/
        $importer = app(GeonamesImporter::class);


        //When
        $importer->loadLocations();

    }
}