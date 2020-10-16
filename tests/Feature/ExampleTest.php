<?php

namespace Tests\Feature;
use App\User;
use App\adduser;
use Illuminate\Http\Request;

use Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_login_user_add_data()
    {
        $response = $this->get('/add')
            ->assertRedirect('/login');
    }   
    
    public function test_authenticate_user_see_the_data()
    {

        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('home');

    }

    public function test_login_credentials()
    {
        $user = factory(User::class)->create([
            'password'=>bcrypt($passsword='12345678'),
        ]);
        $response = $this->post('/login',[
            'email'=> $user->email,
            'password'=>$passsword,
        ]);
        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }



    public function test_login_user_form()
    {
        $this->get('/login')
            ->assertStatus(200);
    }


    public function test_user_can_view_login()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }


    public function test_it_validates_form()
    {
        $adduser = factory(adduser::class)->create();
        $response = $this->actingAs($adduser)
        ->json('POST','/add',[
            'name'=>'test',
            'number'=>9558239911,
            'address'=>'asjd'
        ]);
        $response->assertOk();

    }

    public function test_it_should_forbid_an_unauthenticated_user_to_create_post()
    {
        $response = $this->json('POST','/add',[
            'name'=>'athar',
            'number'=>95582911,
            'address'=>'atasd'
        ]);
        $response->assertForbidden();
    }

    public function test_it_should_fail_validation_when_creating_a_blog_post_without_title()
    {
        $user = factory(adduser::class)->create();

        $response = $this->actingAs($user)
            ->json('POST', '/add', [
                'address' => 'this is a test'
            ]);

        $response->assertStatus(422);
        $response->assertValidationErrors(['name','number']);

       
    }


    public function test_it_should_contain_all_the_expected_validation_rules()
    {
        $request = new AdduserRequest();

        $this->assertEquals([
            'name' => 'required|string',
            'number'=>'required|digits:10',
            'address' => 'required|string'
        ], $request->rules());
    }

   

    

}
