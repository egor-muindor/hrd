<?php

namespace App\Jobs;

use App\Models\Addiction;
use App\Models\Application;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;
use SoapClient;
use Storage;


/**
 * @property Application application
 */
class ExportTo1C implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $application;

    /**
     * Create a new job instance.
     *
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws Exception
     */
    public function handle()
    {
        try {
            $client = new SoapClient(config('app.address_1c')); //для 1с
            $data = array(
                'first_name' => $this->application->first_name,
                'middle_name' => $this->application->middle_name,
                'last_name' => $this->application->last_name,
                'post_id' => $this->application->post->name,
                'passport_id' => $this->application->passport_id,
                'employment_history' => $this->application->employment_history,
                'snils' => $this->application->snils,
                'inn' => $this->application->inn,
                'scientific_works' => $this->application->scientific_works,
                'email' => $this->application->email,
                'status' => 'Не проверена',
                'description' => $this->application->description);

            $response = $client->SendApplication($data); // ответ от 1с

            // Удаление всех приложений
            $addictions = Addiction::whereApplicationId($this->application->id)->get();
            foreach ($addictions as $addiction) {
                // тут можно обработать все приложения перед удалением
                Storage::delete($addiction->file);
                $addiction->forceDelete();
            }

            $this->application->forceDelete();
            $this->delete();
        } catch (Exception $error) {
            throw new Exception($error, 101);
        }
    }


    /**
     * The job failed to process.
     *
     * @param Exception $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        Log::info('[ERROR]', [$exception]);

    }
}
