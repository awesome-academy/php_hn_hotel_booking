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
                ->signIn($email, $password)
                ->assertSee('Login successfully')
                ->press('@book')
                ->pause(2000)
                ->click('.dropdown li')
                ->pause(2000);
        });
    }

    public function testLoginFailed()
    {
        $email = "customer@gmail.com" ;
        $password = "wrongPass";
        $this->browse(function (Browser $browser) use ($email, $password) {
            $browser->visit(new LoginPage())
                ->signIn($email, $password)
                ->assertSee('Email or password not correct')
                ->pause(2000);
        });
    }
}
