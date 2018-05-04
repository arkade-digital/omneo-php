<?php

namespace Omneo\Modules;

use Illuminate\Support\Collection;
use Omneo;
use GuzzleHttp;
use \Mockery as m;

class IdentitiesTest extends Omneo\TestCase
{
    /**
     * @test
     */
    public function can_access_module_from_client_with_profile()
    {
        $client = new Omneo\Client('foo.omneo.io', 'batteryhorsestaple');

        $module = $client->identities(new Omneo\Profile(['id' => 999]));

        $this->assertInstanceOf(Identities::class, $module);
    }

    /**
     * @test
     */
    public function browse_returns_collection_of_identities()
    {
        $module = new Identities(
            $client = m::mock(Omneo\Client::class),
            new Omneo\Profile(['id' => 999])
        );

        $client
            ->shouldReceive('get')
            ->with('profiles/999/identities')
            ->once()
            ->andReturn(
                new GuzzleHttp\Psr7\Response(200, [], $this->stub('identities/collection.json'))
            );

        $collection = $module->browse();

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertInstanceOf(Omneo\Identity::class, $collection->first());
        $this->assertEquals(2, $collection->count());
    }

    /**
     * @test
     */
    public function read_returns_identity()
    {
        $module = new Identities(
            $client = m::mock(Omneo\Client::class),
            new Omneo\Profile(['id' => 999])
        );

        $client
            ->shouldReceive('get')
            ->with('profiles/999/identities/zendesk')
            ->once()
            ->andReturn(
                new GuzzleHttp\Psr7\Response(200, [], $this->stub('identities/entity.json'))
            );

        $identity = $module->read('zendesk');

        $this->assertInstanceOf(Omneo\Identity::Class, $identity);
        $this->assertEquals('zendesk', $identity->handle);
        $this->assertEquals('123', $identity->identifier);
    }

    /**
     * @test
     */
    public function edit_returns_identity()
    {
        $module = new Identities(
            $client = m::mock(Omneo\Client::class),
            new Omneo\Profile(['id' => 999])
        );

        $identity = new Omneo\Identity(
            $this->jsonStub('identities/entity.json')['data']
        );

        $identity->identifier = 'abc';

        $client
            ->shouldReceive('put')
            ->with('profiles/999/identities/zendesk', [
                'json' => ['identifier' => 'abc']
            ])
            ->once()
            ->andReturn(
                new GuzzleHttp\Psr7\Response(200, [], $this->stub('identities/entity.json'))
            );

        $identity = $module->edit($identity);

        $this->assertInstanceOf(Omneo\Identity::Class, $identity);
    }

    /**
     * @test
     */
    public function add_returns_identity()
    {
        $module = new Identities(
            $client = m::mock(Omneo\Client::class),
            new Omneo\Profile(['id' => 999])
        );

        $identity = new Omneo\Identity(
            $this->jsonStub('identities/entity.json')['data']
        );

        $client
            ->shouldReceive('post')
            ->with('profiles/999/identities', [
                'json' => $identity->toArray()
            ])
            ->once()
            ->andReturn(
                new GuzzleHttp\Psr7\Response(200, [], $this->stub('identities/entity.json'))
            );

        $identity = $module->add($identity);

        $this->assertInstanceOf(Omneo\Identity::Class, $identity);
    }

    /**
     * @test
     */
    public function delete_sends_delete_request()
    {
        $module = new Identities(
            $client = m::mock(Omneo\Client::class),
            new Omneo\Profile(['id' => 999])
        );

        $identity = new Omneo\Identity(
            $this->jsonStub('identities/entity.json')['data']
        );

        $client
            ->shouldReceive('delete')
            ->with('profiles/999/identities/zendesk')
            ->once()
            ->andReturn(
                new GuzzleHttp\Psr7\Response(200)
            );

        $module->delete($identity);
    }
}