<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Pages\LoginPage;

class LoginViewTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testLoginSuccessfully()
    {
        $email = "customer@gmail.com" ;
        $password = "11111111";
        $this->browse(function (Browser $browser) use ($email, $password) {
            $browser->visit(new LoginPage())
                ->assertRouteIs('auth.customer.loginForm')
                ->assertPresent(".login-wrap")
                ->signIn($email, $password)
                ->assertSee('Login successfully')
                ->assertRouteIs('booking.index')
                ->assertAuthenticated()
                ->press('@book')
                ->click('.dropdown li')
                ->assertRouteIs('customer.profile')
                ->back();
        });
    }

    public function testLoginFailed()
    {
        $email = "customer@gmail.com" ;
        $password = "wrongPass";
        $this->browse(function (Browser $browser) use ($email, $password) {
            $browser->visit(new LoginPage())
                ->assertRouteIs('auth.customer.loginForm')
                ->assertPresent(".login-wrap")
                ->signIn($email, $password)
                ->assertRouteIs('auth.customer.loginForm')
                ->assertSee('Email or password not correct');
        });
    }
}
