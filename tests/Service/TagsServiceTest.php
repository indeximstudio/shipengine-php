<?php declare(strict_types=1);

namespace Service;

use PHPUnit\Framework\TestCase;

use ShipEngine\ShipEngine;

/**
 * Tests the methods provided in the `TagsService`.
 *
 * @covers \ShipEngine\Model\Tags\Tag
 * @covers \ShipEngine\Service\TagsService
 * @covers \ShipEngine\Service\TagsTrait
 * @covers \ShipEngine\Service\AbstractService
 * @covers \ShipEngine\Service\ServiceFactory
 * @covers \ShipEngine\ShipEngine
 * @covers \ShipEngine\ShipEngineClient
 * @covers \ShipEngine\ShipEngineConfig
 */
class TagsServiceTest extends TestCase
{
    /**
     * @var ShipEngine
     */
    private ShipEngine $shipengine;

    /**
     * Import `simengine/rpc/rpc.json` into *Hoverfly* before class instantiation.
     *
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        exec('hoverctl import simengine/rpc/rpc.json');
    }

    /**
     * Delete `simengine/rpc/rpc.json` from *Hoverfly*.
     *
     * @return void
     */
    public static function tearDownAfterClass(): void
    {
        exec('hoverctl delete --force simengine/rpc/rpc.json');
    }

    /**
     * Add the config array setting the `api-key` and `base_uri` on the new instance of the *ShipEngine* class.
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->shipengine = new ShipEngine(['api_key' => 'baz', 'base_uri' => 'http://localhost:8500']);
    }

    /**
     * Test the `create()` convenience method on the *TagsService* successfully creates a new tag using
     * the `create_tag` remote procedure.
     *
     * @return void
     */
    public function testCreateTagRequest(): void
    {
        $test_value = 'calque_rpc';
        $new_tag = $this->shipengine->tags->create(array('name' => $test_value));

        $this->assertEquals($new_tag->name, $test_value);
    }
}