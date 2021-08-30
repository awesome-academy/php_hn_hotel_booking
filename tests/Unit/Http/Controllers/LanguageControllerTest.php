<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\LanguageController;
use Illuminate\Http\Request;
use Tests\TestCase;

class LanguageControllerTest extends TestCase
{
    protected $languageController;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->languageController = new LanguageController();
    }
    public function testChangeLanguage()
    {
        $request = new Request();
        $this->withSession([
            'locale' => 'vn'
        ]);
        $result = $this->languageController->changeLanguage($request);
        $this->assertEquals(url()->previous(), $result->getTargetUrl());
    }

    protected function tearDown(): void
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
    }
}
