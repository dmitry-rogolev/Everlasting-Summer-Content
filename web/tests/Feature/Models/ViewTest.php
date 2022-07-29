<?php

namespace Tests\Feature\Models;

use App\Models\Content;
use App\Models\User;
use App\Models\View;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function test_view_can_get_user()
    {
        $view = View::factory()->for(User::factory())->create();

        $this->assertModelExists($view->user);
    }

    public function test_view_can_get_content()
    {
        $view = View::factory()->for(Content::factory())->create();

        $this->assertModelExists($view->content);
    }
}
