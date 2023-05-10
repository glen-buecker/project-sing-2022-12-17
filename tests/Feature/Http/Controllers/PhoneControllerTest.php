<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Contact;
use App\Models\Phone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PhoneController
 */
class PhoneControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $phones = Phone::factory()->count(3)->create();

        $response = $this->get(route('phone.index'));

        $response->assertOk();
        $response->assertViewIs('phone.index');
        $response->assertViewHas('phones');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('phone.create'));

        $response->assertOk();
        $response->assertViewIs('phone.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PhoneController::class,
            'store',
            \App\Http\Requests\PhoneStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $contact = Contact::factory()->create();
        $type = $this->faker->randomElement(/** enum_attributes **/);
        $number = $this->faker->word;

        $response = $this->post(route('phone.store'), [
            'contact_id' => $contact->id,
            'type' => $type,
            'number' => $number,
        ]);

        $phones = Phone::query()
            ->where('contact_id', $contact->id)
            ->where('type', $type)
            ->where('number', $number)
            ->get();
        $this->assertCount(1, $phones);
        $phone = $phones->first();

        $response->assertRedirect(route('phone.index'));
        $response->assertSessionHas('phone.id', $phone->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $phone = Phone::factory()->create();

        $response = $this->get(route('phone.show', $phone));

        $response->assertOk();
        $response->assertViewIs('phone.show');
        $response->assertViewHas('phone');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $phone = Phone::factory()->create();

        $response = $this->get(route('phone.edit', $phone));

        $response->assertOk();
        $response->assertViewIs('phone.edit');
        $response->assertViewHas('phone');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PhoneController::class,
            'update',
            \App\Http\Requests\PhoneUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $phone = Phone::factory()->create();
        $contact = Contact::factory()->create();
        $type = $this->faker->randomElement(/** enum_attributes **/);
        $number = $this->faker->word;

        $response = $this->put(route('phone.update', $phone), [
            'contact_id' => $contact->id,
            'type' => $type,
            'number' => $number,
        ]);

        $phone->refresh();

        $response->assertRedirect(route('phone.index'));
        $response->assertSessionHas('phone.id', $phone->id);

        $this->assertEquals($contact->id, $phone->contact_id);
        $this->assertEquals($type, $phone->type);
        $this->assertEquals($number, $phone->number);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $phone = Phone::factory()->create();

        $response = $this->delete(route('phone.destroy', $phone));

        $response->assertRedirect(route('phone.index'));

        $this->assertSoftDeleted($phone);
    }
}
