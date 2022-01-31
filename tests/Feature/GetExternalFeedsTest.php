<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
use App\Jobs\GetFeedFromExternalServer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetExternalFeedsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_external_feeds_job_is_dispatched()
    {
        Queue::fake();

        // Dispatch job
        Http::fake();
        GetFeedFromExternalServer::dispatch();

        // Assert a job was pushed to a given queue...
        Queue::assertPushedOn('external_posts_generation', GetFeedFromExternalServer::class);
    }
}
