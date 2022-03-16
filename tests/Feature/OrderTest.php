<?php

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Carbon;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Testing for store route method
     * Required route is POST 
     * @route object/
     */
    public function test_store_throw_error_if_store_route_is_get()
    {
        $response = $this->get('object',["key" => "value"]);
        $response->assertStatus(405);
    }

    /**
     * Testing for store  - validate empty input
     * @route object/
     */
    public function test_store_throw_error_for_empty_json_input()
    {
        $response = $this->postJson('object', []);
        $response
            ->assertStatus(422);
        
    }

    /**
     * Testing for store  - validate empty key input
     * @route object/
     */
    public function test_store_throw_error_if_key_is_empty()
    {
        $data = ["" => "value1"];
        $response = $this->postJson('object',$data);
        $response
            ->assertStatus(422);
    }

    /**
     * Testing for store  - validate empty value input
     * @route object/
     */
    public function test_store_throw_error_if_value_is_empty()
    {
        $data = ['key1' => ""];
        $response = $this->postJson('object', $data);
        $response
            ->assertStatus(422);
    }

    /**
     * Testing for store  - validate empty key and value input
     * @route object/
     */
    public function test_store_throw_error_if_key_and_value_are_empty()
    {
        $data = ["" => ""];
        $response = $this->postJson('object', $data);
        $response
            ->assertStatus(422);
    }
    /**
     * Testing for store  - validate key length
     * @route object/
     */

    public function test_store_throw_error_if_key_length_greater_than_255()
    {
        $data = [
            "key-namekey-namekey-namekey-namekey-namekey-namekeykey-name
            -namekey-namekey-namekey-namekey-namekey-namekeykey-namekey-name
            -namekey-namekey-namekey-namekey-namekey-namekey-namekey-name
            key-namekey-namekey-namekey-namekey-namekey-namekey-namekey-name
            key-namekey-namekey-namekey-namekey-namekey-namekey-namekey-name
            key-namekey-namekey-namekey-namekey-namekey-namekey-namekey-name
            key-namekey-namekey-namekey-namekey-namekey-namekey-namekey-name
            key-namekey-namekey-namekey-namekey-namekey-namekey-namekey-namekey-name
            key-namekey-namekey-namekey-namekey-namekey-namekey-namekey-namekey-name" 
            => ""];
        $response = $this->postJson('object', $data);
        $response
            ->assertStatus(422);
    }
    /**
     * Testing for store  - Store data with valid input
     * @route object/
     */

    public function test_store_key_value_pair_with_valid_json_input()
    {
        $response = $this->postJson('object', ["secretLabKey" => "No ending for Innovation"]);
        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => ["secretLabKey" => "No ending for Innovation"]
            ]);  
    }

    /**
     * Testing for store - Update data with valid input 
     * It is for existing key
     * @route object/
     */
    public function test_update_value_for_existing_key()
    {
        $response = $this->postJson('object', ["secretLabKey" => "Make it Happen!"]);
        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => ["secretLabKey" => "Make it Happen!"]
            ]);
    }

    /**
     * Testing for get key object route method
     * Required method is GET
     * @route object/{key}
     */
    public function test_get_throw_error_if_get_key_route_is_post()
    {
        $response = $this->post('object/secretLabKey');
        $response->assertStatus(405);
    }

    /**
     * Testing for get key object
     * @route object/{key}
     */

    public function test_get_value_for_existing_key()
    {
        $this->postJson('object', ["secretLabKey" => "Make it Happen!"]);
        $response = $this->get('object/secretLabKey');
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => ["secretLabKey" => "Make it Happen!"]
            ]);
    }

    /**
     * Testing for get key object with timestamp
     * @route object/{key}?timestamp={timestamp}
     */
    public function test_get_value_for_existing_key_for_given_timestamp()
    {
        $order = Order::factory()->create();
        $response = $this->get('object/'. $order->name.'?timestamp='. strtotime($order->updated_at));
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [$order->name => $order->value]
        ]);
    }

    /**
     * Testing for get key object  - throw error if given key is not found in DB
     * @route object/{key}
     */
    public function test_get_throw_error_if_given_key_is_not_found(){
        $response = $this->get('object/sdfsdfsdf');
        $response
            ->assertStatus(400)
            ->assertJson([
                'errors' => ["message" => "No key is found"]
            ]);
    }

    /**
     * Testing for get key object with timestamp request
     * Throw error if key object does not have for a given timestamp
     * @route object/{key}?timestamp={timestamp}
     */
    public function test_get_throw_error_if_value_is_not_found_for_given_key_and_timestamp()
    {
        $order = Order::factory()->create();
        $response = $this->get('object/' . $order->name . '?timestamp=16471615610234');
        $response
            ->assertStatus(400)
            ->assertJson([
                'errors' => ["message" => "No value is found for the given key and timestamp"]
            ]);
    }
    /**
     * Testing for display all record route method
     * @route object/get_all_records
     */

    public function test_get_throw_error_if_all_records_route_is_post()
    {
        $response = $this->post('object/get_all_records');
        $response->assertStatus(405);
    }

    /**
     * Testing for display all record route
     * @route object/get_all_records
     */

    public function test_get_all_records_route()
    {
        $response = $this->get('object/get_all_record');
        $response->assertStatus(200);
    }
}
