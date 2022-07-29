<?php

namespace Tests\Feature\Models;

use App\Models\Content;
use App\Models\Download;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DownloadTest extends TestCase
{
    public function test_download_can_get_user()
    {
        $download = Download::factory()->for(User::factory())->create();

        $this->assertModelExists($download->user);
    }

    public function test_download_can_get_content()
    {
        $download = Download::factory()->for(Content::factory())->create();

        $this->assertModelExists($download->content);
    }
}
