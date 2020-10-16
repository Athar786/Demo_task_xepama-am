<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class LoginTest extends TestCase
{

    use RefreshDatabase;

    public function testExamples()
    {
        $this->assertTrue(true);
    }

    public function test_user_can_view_login_form()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');


    }

    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/home');
    }
    
    public function test_user_can_login_with_correct_credentials()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password='12354678'),
        ]);
        $response = $this->post('/login',[
            'email'=>$user->email,
            'password'=>$password,
        ]);
        $response->assertredirect('/home');
        $this->assertAuthenticatedAs($user);
        
    }

    public function test_user_cannot_login_with_incorrect_password()
    {
        $user = factory(User::class)->create([
            'password'=>bcrypt('25896321'),
        ]);

        $response = $this->from('/login')->post('/login',[
            'email'=>$user->email,
            'password'=>'invalid-password',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

}
