<?php

require_once dirname(__FILE__).'/../../../server/lib/Artist.php';

/**
 * Test class for Artist.
 * Generated by PHPUnit on 2016-09-03 at 17:21:41.
 */
class ArtistTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Artist
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before the test case class' first test.
     */
    public static function setUpBeforeClass()
    {
        require_once dirname(__FILE__).'/../../TestingTool.php';
        $test = new TestingTool();
        $test->setupDummySqlConnection();
    }


    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Artist;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        unset($this->object);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a the test case class' last test.
     */
    public static function tearDownAfterClass()
    {
        require_once dirname(__FILE__).'/../../TestingTool.php';
        $test = new TestingTool();
        $test->restoreConfig();
    }

    /**
     * Provides an Artist object for processing
     */
    public function dummyArtistProvider()
    {
        $artistDummy = new Artist();
        $artistDummy->id = 11;
        $artistDummy->name = 'artistName';
        $artistDummy->country = 'FR';
        $artistDummy->summary = 'artistSummary';
        $artistDummy->mbid = 'azertyuiopqsdfghjklmwxcvbn0123456789';

        return $artistDummy;
    }

    /**
     * @covers Artist::__construct
     */
    public function testConstruct()
    {
        $this->object = new Artist;
        $this->assertNull($this->object->id, 'Id should be null');
        $this->object = new Artist(99);
        $this->assertEquals(99, $this->object->id, 'Id should be set');

    }

    /**
     * @covers Artist::validateModel
     */
    public function testValidateModel()
    {
        $artistDummy = $this->dummyArtistProvider();
        $this->assertTrue($this->object->validateModel($artistDummy, $error), 'Artist validation should be ok, but returned reason:'.$error);
        $this->assertEquals($artistDummy->id, $this->object->id, 'Artist id should have been set during validation');
        $this->assertEquals($artistDummy->name, $this->object->name, 'Artist name should have been set during validation');
        $this->assertEquals($artistDummy->country, $this->object->country, 'Artist country should have been set during validation');
        $this->assertEquals($artistDummy->summary, $this->object->summary, 'Artist summary should have been set during validation');
        $this->assertEquals($artistDummy->mbid, $this->object->mbid, 'Artist mbid should have been set during validation');

        return $this->object;
    }

    /**
     * @covers Artist::validateModel
     */
    public function testValidateModelWithoutModel()
    {
        $this->assertFalse($this->object->validateModel(null, $error), 'Artist validation should not be ok');
        $this->assertEquals('invalid resource', $error, 'Error message should be "invalid resource" but returned: '.$error);
    }

    /**
     * @covers Artist::validateModel
     */
    public function testValidateModelWithErrorOnId()
    {
        $artistDummy = $this->dummyArtistProvider();
        $artistDummy->id = null;
        $this->assertFalse($this->object->validateModel($artistDummy, $error), 'Artist validation should not be ok');
        $this->assertEquals('integer must be provided in id attribute', $error, 'Error message should be "integer must be provided in id attribute" but returned: '.$error);
        $this->assertNull($this->object->id, 'Artist id should not have been set during validation');
        $this->assertEquals($artistDummy->name, $this->object->name, 'Artist name should have been set during validation');
        $this->assertEquals($artistDummy->country, $this->object->country, 'Artist country should have been set during validation');
        $this->assertEquals($artistDummy->summary, $this->object->summary, 'Artist summary should have been set during validation');
        $this->assertEquals($artistDummy->mbid, $this->object->mbid, 'Artist mbid should have been set during validation');
        $artistDummy->id = '1';
        $this->assertFalse($this->object->validateModel($artistDummy, $error), 'Artist validation should not be ok');
        $this->assertEquals('integer must be provided in id attribute', $error, 'Error message should be "integer must be provided in id attribute" but returned: '.$error);
    }

    /**
     * @covers Artist::validateModel
     */
    public function testValidateModelWithErrorOnName()
    {
        $artistDummy = $this->dummyArtistProvider();
        $artistDummy->name = null;
        $this->assertFalse($this->object->validateModel($artistDummy, $error), 'Artist validation should not be ok');
        $this->assertEquals('string must be provided in name attribute', $error, 'Error message should be "string must be provided in name attribute" but returned: '.$error);
        $this->assertEquals($artistDummy->id, $this->object->id, 'Artist id should have been set during validation');
        $this->assertNull($this->object->name, 'Artist name should not have been set during validation');
        $this->assertEquals($artistDummy->country, $this->object->country, 'Artist country should have been set during validation');
        $this->assertEquals($artistDummy->summary, $this->object->summary, 'Artist summary should have been set during validation');
        $this->assertEquals($artistDummy->mbid, $this->object->mbid, 'Artist mbid should have been set during validation');

        $artistDummy->name = '';
        $this->assertFalse($this->object->validateModel($artistDummy, $error), 'Artist validation should not be ok');
        $this->assertEquals('string must be provided in name attribute', $error, 'Error message should be "string must be provided in name attribute" but returned: '.$error);
    }

    /**
     * @covers Artist::validateModel
     */
    public function testValidateModelWithoutSummary()
    {
        $artistDummy = $this->dummyArtistProvider();
        $artistDummy->summary = null;
        $this->assertTrue($this->object->validateModel($artistDummy, $error), 'Artist validation should be ok, but returned reason:'.$error);
        $this->assertEquals($artistDummy->id, $this->object->id, 'Artist id should have been set during validation');
        $this->assertEquals($artistDummy->name, $this->object->name, 'Artist name should have been set during validation');
        $this->assertEquals($artistDummy->country, $this->object->country, 'Artist country should have been set during validation');
        $this->assertNull($this->object->summary, 'Artist summary should not have been set during validation');
        $this->assertEquals($artistDummy->mbid, $this->object->mbid, 'Artist mbid should have been set during validation');

        $artistDummy->summary = '';
        $this->assertTrue($this->object->validateModel($artistDummy, $error), 'Artist validation should be ok, but returned reason:'.$error);
        $this->assertNull($this->object->summary, 'Artist summary should not have been set during validation');
    }

    /**
     * @covers Artist::validateModel
     */
    public function testValidateModelWithoutCountry()
    {
        $artistDummy = $this->dummyArtistProvider();
        $artistDummy->country = null;
        $this->assertTrue($this->object->validateModel($artistDummy, $error), 'Artist validation should be ok, but returned reason:'.$error);
        $this->assertEquals($artistDummy->id, $this->object->id, 'Artist id should have been set during validation');
        $this->assertEquals($artistDummy->name, $this->object->name, 'Artist name should have been set during validation');
        $this->assertNull($this->object->country, 'Artist country should not have been set during validation');
        $this->assertEquals($artistDummy->summary, $this->object->summary, 'Artist summary should have been set during validation');
        $this->assertEquals($artistDummy->mbid, $this->object->mbid, 'Artist mbid should have been set during validation');

        $artistDummy->country= '';
        $this->assertTrue($this->object->validateModel($artistDummy, $error), 'Artist validation should be ok, but returned reason:'.$error);
        $this->assertNull($this->object->country, 'Artist country should not have been set during validation');

        $artistDummy->country= 'CountryTooLong';
        $this->assertFalse($this->object->validateModel($artistDummy, $error), 'Artist validation should not be ok');
        $this->assertEquals('String with a valid format must be provided in country attribute', $error, 'Error message should be "String with a valid format must be provided in country attribute" but returned: '.$error);
    }

    /**
     * @covers Artist::validateModel
     */
    public function testValidateModelWithoutMbid()
    {
        $artistDummy = $this->dummyArtistProvider();
        $artistDummy->mbid = null;
        $this->assertTrue($this->object->validateModel($artistDummy, $error), 'Artist validation should be ok, but returned reason:'.$error);
        $this->assertEquals($artistDummy->id, $this->object->id, 'Artist id should have been set during validation');
        $this->assertEquals($artistDummy->name, $this->object->name, 'Artist name should have been set during validation');
        $this->assertEquals($artistDummy->country, $this->object->country, 'Artist country should have been set during validation');
        $this->assertEquals($artistDummy->summary, $this->object->summary, 'Artist summary should have been set during validation');
        $this->assertNull($this->object->mbid, 'Artist MBID should not have been set during validation');

        $artistDummy->mbid= '';
        $this->assertTrue($this->object->validateModel($artistDummy, $error), 'Artist validation should be ok, but returned reason:'.$error);
        $this->assertNull($this->object->mbid, 'Artist MBID should not have been set during validation');

        $artistDummy->mbid = 'MbidShorterThan36';
        $this->assertFalse($this->object->validateModel($artistDummy, $error), 'Artist validation should not be ok');
        $this->assertEquals('String with a valid format must be provided in MBID attribute', $error, 'Error message should be "String with a valid format must be provided in MBID attribute" but returned: '.$error);
    }

    /**
     * @covers Artist::insert
     * @covers Artist::insertIfRequired
     */
    public function testInsertIfRequired()
    {
        $artistDummy = $this->dummyArtistProvider();
        $this->object->mbid = $artistDummy->mbid;
        $result = $this->object->insertIfRequired($artistDummy->name, $artistDummy->mbid);
        $this->assertEquals(1, $result, 'Artist should be inserted with id #1 but returned: '.$result);

        $artistDummy->name .= '2';
        $result = $this->object->insertIfRequired($artistDummy->name, $artistDummy->mbid);
        $this->assertEquals(2, $result, 'Artist should be inserted with id #2 but returned: '.$result);

        $result = $this->object->insertIfRequired($artistDummy->name, $artistDummy->mbid);
        $this->assertEquals(2, $result, 'Artist should be retrieved with id #2 but returned: '.$result);
    }

    /**
     * @covers Artist::insert
     * @covers Artist::insertIfRequired
     */
    public function testInsertIfRequiredWithError()
    {
        //get dummy artist and change his name to force creation
        $artistDummy = $this->dummyArtistProvider();
        $artistDummy->name = 'newValue';
        //create stub that will return false when insert function will be called
        $stub = $this->getMock('Artist', array('insert'));
        $stub->expects($this->any())->method('insert')->will($this->returnValue(false));
        //test it
        $result = $stub->insertIfRequired($artistDummy->name, null);
        $this->assertFalse($result);
    }

    /**
     * @covers Artist::update
     */
    public function testUpdate()
    {
        $artistDummy = $this->dummyArtistProvider();
        $artistDummy->id = 2;
        $artistDummy->name .= 'updated';
        $artistDummy->mbid = 'azertyuiopqsdfghjklmwxcvbn9876543210';
        $artistDummy->summary .= 'updated';
        $artistDummy->country = 'UP';

        $this->object->id = $artistDummy->id;
        $this->object->name = $artistDummy->name;
        $this->object->mbid = $artistDummy->mbid;
        $this->object->summary = $artistDummy->summary;
        $this->object->country = $artistDummy->country;
        $this->assertTrue($this->object->update($error), 'Update should be valid');

        return $artistDummy;
    }

    /**
     * @covers Artist::update
     */
    public function testUpdateWithoutId()
    {
        $artistDummy = $this->dummyArtistProvider();
        $artistDummy->id = 'alpha';

        $this->object->id = $artistDummy->id;
        $this->object->name = $artistDummy->name;
        $this->object->mbid = $artistDummy->mbid;

        $this->assertFalse($this->object->update($error), 'Update should not be valid without valid id');

        return $artistDummy;
    }

    /**
     * @covers Artist::populate
     * @depends testUpdate
     */
    public function testPopulate(Artist $updatedArtistDummy)
    {
        $artistDummy = $this->dummyArtistProvider();
        //populate by name, expected no match
        $this->assertFalse($this->object->populate(['name' => 'nameValue']), 'Populate should not find any artist with name nameValue');
        //populate by name, expected match
        $this->assertTrue($this->object->populate(['name' => 'artistName']), 'Populate should find the created artist with name '.$artistDummy->name);
        //populate by mbid, expected match
        $this->assertTrue($this->object->populate(['mbid' => $artistDummy->mbid]), 'Populate should find the created artist with mbid '.$artistDummy->mbid);
        //populate by id, expected match
        $this->assertTrue($this->object->populate(['id' => 2]), 'Populate should find the created artist with id 2 (previously created)');
        //populate by all criteria, expected match
        $this->assertTrue($this->object->populate(['id' => 2, 'mbid' => $updatedArtistDummy->mbid, 'name' => $updatedArtistDummy->name]), 'Populate should find the created artist with id 2 (previously created)');
        //check populate return all attributes
        $this->assertEquals($updatedArtistDummy->name, $this->object->name, 'Artist name should have been set during populate');
        $this->assertEquals($updatedArtistDummy->country, $this->object->country, 'Artist country should have been set during populate');
        $this->assertEquals($updatedArtistDummy->summary, $this->object->summary, 'Artist summary should have been set during populate');
        $this->assertEquals($updatedArtistDummy->mbid, $this->object->mbid, 'Artist mbid should have been set during populate');
    }

    /**
     * @covers Artist::getTracks
     */
    public function testGetTracks()
    {
        $this->object->id = 1;
        $result = $this->object->getTracks();
        $this->assertInternalType('array', $result);
    }

    /**
     * @covers Artist::delete
     */
    public function testDelete()
    {
        $this->object->id = 'alpha';
        $this->assertFalse($this->object->delete(), 'Artist should not be deleted');

        $this->object->id = null;
        $this->assertFalse($this->object->delete(), 'Artist should not be deleted');

        $this->object->id = 2;
        $this->assertTrue($this->object->delete(), 'Artist should be deleted');

    }

    /**
     * @covers Artist::structureData
     */
    public function testStructureData()
    {
        $this->object->id = '50';
        $this->object->name = 'artistName50';
        $artist = $this->object->structureData();
        $this->assertInstanceOf(Artist::class, $artist, 'Result should be an instance of Artist class');
        $this->assertEquals(50, $artist->id, 'Id should be convert in integer');
        $this->assertEquals('artistName50', $artist->name, 'Name should be set to artistName50, but found:'.$artist->name);
    }
}
