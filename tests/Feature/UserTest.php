<?php

namespace Tests\Feature;


use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;


class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_create_and_read_user(): void
    {
        $user = new User();
        $user->name = "ギャバン";
        $user->email = "gavan@example.com";
        $user->password = Hash::make('password');
        $user->save();

        $read_user = User::where('name', 'ギャバン')->first();

        $this->assertInstanceOf(User::class, $read_user);
        $this->assertTrue(Hash::check('password', $read_user->password));

        $user->delete();
    }
}
