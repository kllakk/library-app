<?php


use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Register user test example.
     *
     * @return void
     */
    public function testRegisterTest()
    {
        $faker = \Faker\Factory::create();
        $username = $faker->userName;

        $payload = [
            'name' => $username,
            'password' => 'test',
            'email' => "{$username}@test.test",
        ];

        $this->post('/api/auth/registration', $payload, [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json',
        ])->assertStatus(200)->assertJsonStructure(['message'])->assertJson([
            'message' => 'Successfully registration!',
        ]);
    }

    /**
     * Login user test example.
     *
     * @return void
     */
    public function testLoginTest()
    {
        $faker = \Faker\Factory::create();
        $password = $faker->password;

        $user = User::create([
            'name' => $faker->userName,
            'email' => $faker->email,
            'password' => bcrypt($password),
        ]);

        $payload = [
            'email' => $user->email,
            'password' => $password,
        ];

        var_dump($payload);

        $this->post('/api/auth/login', $payload, [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json',
        ])->assertStatus(200)->assertJsonStructure(['access_token', 'token_type', 'expires_in']);
    }
}
