<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class LoginPage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/customer/login';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@email' => 'input[name=email]',
            '@pass' => 'input[name=password]',
            '@login' => 'button.btn-search4',
            '@book' => 'button.bookbtn',
        ];
    }

    public function signIn(Browser $browser, $email, $password)
    {
        $browser->value('@email', $email)
                ->value('@pass', $password)
                ->press('@login');
    }
}
