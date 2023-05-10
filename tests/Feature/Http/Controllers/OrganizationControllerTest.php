<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Organization;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\OrganizationController
 */
class OrganizationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $organizations = Organization::factory()->count(3)->create();

        $response = $this->get(route('organization.index'));

        $response->assertOk();
        $response->assertViewIs('organization.index');
        $response->assertViewHas('organizations');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('organization.create'));

        $response->assertOk();
        $response->assertViewIs('organization.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OrganizationController::class,
            'store',
            \App\Http\Requests\OrganizationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $type = $this->faker->randomElement(/** enum_attributes **/);
        $named = $this->faker->word;
        $notes = $this->faker->text;

        $response = $this->post(route('organization.store'), [
            'type' => $type,
            'named' => $named,
            'notes' => $notes,
        ]);

        $organizations = Organization::query()
            ->where('type', $type)
            ->where('named', $named)
            ->where('notes', $notes)
            ->get();
        $this->assertCount(1, $organizations);
        $organization = $organizations->first();

        $response->assertRedirect(route('organization.index'));
        $response->assertSessionHas('organization.id', $organization->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $organization = Organization::factory()->create();

        $response = $this->get(route('organization.show', $organization));

        $response->assertOk();
        $response->assertViewIs('organization.show');
        $response->assertViewHas('organization');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $organization = Organization::factory()->create();

        $response = $this->get(route('organization.edit', $organization));

        $response->assertOk();
        $response->assertViewIs('organization.edit');
        $response->assertViewHas('organization');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OrganizationController::class,
            'update',
            \App\Http\Requests\OrganizationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $organization = Organization::factory()->create();
        $type = $this->faker->randomElement(/** enum_attributes **/);
        $named = $this->faker->word;
        $notes = $this->faker->text;

        $response = $this->put(route('organization.update', $organization), [
            'type' => $type,
            'named' => $named,
            'notes' => $notes,
        ]);

        $organization->refresh();

        $response->assertRedirect(route('organization.index'));
        $response->assertSessionHas('organization.id', $organization->id);

        $this->assertEquals($type, $organization->type);
        $this->assertEquals($named, $organization->named);
        $this->assertEquals($notes, $organization->notes);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $organization = Organization::factory()->create();

        $response = $this->delete(route('organization.destroy', $organization));

        $response->assertRedirect(route('organization.index'));

        $this->assertSoftDeleted($organization);
    }
}
