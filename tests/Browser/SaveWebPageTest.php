<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SaveWebPageTest extends DuskTestCase
{

    public function index()
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('https://example.com')
                ->screenshot('example-page');
        });
    }


}
