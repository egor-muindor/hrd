<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;
use SoapClient;

class RefreshStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $candidate;
    public $tries = 1;
    public $timeout = 5;

    /**
     * Create a new job instance.
     *
     * @param $candidate
     */
    public function __construct($candidate)
    {
        $this->candidate = $candidate;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $client = new SoapClient(config('app.address_1c'),
                array('connection_timeout' => 2, "trace" => false, "exceptions" => true));
        } catch (\SoapFault $e) {
            $this->fail();
        } finally {
            try {
                $data = ['UniqueField' => $this->candidate->uncial_id];
                $response = $client->GetStatus($data);
                if ($response->return !== null and $response->return !== 'На рассмотрении') {
                    $this->update(['status' => $response->return]);
                }
                $this->delete();
            } catch (Exception $e) {
                Log::info('Error', [$e]);
                $this->fail();
            } //для 1с
        }
    }
}
