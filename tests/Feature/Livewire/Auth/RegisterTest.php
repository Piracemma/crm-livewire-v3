<?php

use App\Livewire\Auth\Register;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it('renders successfully', function () {
    Livewire::test(Register::class)
        ->assertStatus(200);
});

it('register new user', function () {

    Livewire::test(Register::class)
        ->set('name', 'Joe Doe')
        ->set('email', 'joe@doe.com')
        ->set('email_confirmation', 'joe@doe.com')
        ->set('password', 'password')
        ->call('submit')
        ->assertHasNoErrors();

    assertDatabaseHas('users', [
        'name' => 'Joe Doe',
        'email' => 'joe@doe.com',
    ]);

    assertDatabaseCount('users', 1);

    expect(auth()->check())
        ->and(auth()->user())
        ->ID->toBe(User::first()->ID);

});

test('validation rules', function ($f) {

    Livewire::test(Register::class)
        ->set($f->field, $f->value)
        ->call('submit')
        ->assertHasErrors([$f->field => $f->rule]);

})->with([
    'name::required' => (object) ['field' => 'name', 'value' => '', 'rule' => 'required'],
    'name::max255' => (object) ['field' => 'name', 'value' => str_repeat('*', 256), 'rule' => 'max:255'],
    'email::required' => (object) ['field' => 'email', 'value' => '', 'rule' => 'required'],
    'email::email' => (object) ['field' => 'email', 'value' => 'not-an-email', 'rule' => 'email'],
    'email::max' => (object) ['field' => 'email', 'value' => str_repeat('*'.'@doe.com', 256), 'rule' => 'max:255'],
    'email::confirmation' => (object) ['field' => 'email', 'value' => 'joe@doe.com', 'rule' => 'confirmed'],
    'password::required' => (object) ['field' => 'password', 'value' => '', 'rule' => 'required'],
]);
