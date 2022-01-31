<?php

namespace App\Jobs;

use Throwable;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use App\Services\PostProcessor;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Exception;
use Illuminate\Http\Client\ConnectionException;

class GetFeedFromExternalServer implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The response from api call to $externalUrl.
     *
     * @var mixed
     */
    protected $response;

    /**
     * @var string
     */
    // http://127.0.0.1:8000/api/posts
    protected $external_url = 'https://sq1-api-test.herokuapp.com/posts';

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;

    /**
     * The maximum number of unhandled exceptions to allow before failing.
     *
     * @var int
     */
    public $maxExceptions = 2;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->onQueue('external_posts_generation');
        $this->response = $this->getFeeds();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(PostProcessor $post_processor)
    {
        $this->chech_response_data();
        // system admin user
        $user = User::getAdministratorUser();
        foreach ($this->response['data'] as $key => $post) {
            if (!(is_string($post['title'])) && !(is_string($post['description'])) && !($this->validateDate($post['publication_date'])))
                return;
            $post_processor->store($user, $post['title'], $post['description'], $post['publication_date']);
        }
    }

    /**
     * Validate date format
     * @return bool
     */
    protected function validateDate($date, $format = 'Y-m-d')
    {
        return Carbon::createFromFormat($format, $date) !== false;
    }

    /**
     * Get feeds from external Url
     */
    protected function getFeeds()
    {
        return Http::retry(3, 100, function ($exception) {
            return $exception instanceof ConnectionException;
        })->acceptJson()->get($this->external_url)->throw()->json();
    }

    /**
     * Fail the job if response data doesn't exist
     * Fail if the response data is not an array
     */
    protected function chech_response_data()
    {
        if (empty($this->response['data']) && (is_array($this->response['data']))) {
            $this->fail(new Exception('wrong data format'));
        }
    }

    /**
     * Handle a job failure.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(Throwable $exception)
    {
        // Send user notification of failure, etc...
        Log::error('Get External Feed Failed', [$this->response]);
    }
}
