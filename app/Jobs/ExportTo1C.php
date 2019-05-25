<?php

namespace App\Jobs;


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
        /**
         * Его я не трогал, так что он работать не будет как есть, нужно переписывать
         */
        try {
            $client = new SoapClient(config('app.address_1c')); //для 1с
//            $client = new SoapClient('http://192.168.56.1/I1C/ws/ws3.1cws?wsdl');
            $addictions = Addiction::whereApplicationId($this->application->id)->get();
            $array_with_links = []; //Массив, в котором будем передавать ссылки
            foreach ($addictions as $addiction) {
                $url = Storage::url($addiction->file);
                $desc = $addiction->description;
                $extension = substr(strrchr($addiction->file, '.'), 1);
                if (!empty($extension)) {
                    $array_with_links[] = [$url, $desc, $extension];  //Загоняем ссылки и описания в массив для передачи
                }
            }

            $dat = [
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
                'description' => $this->application->description,
                'data' => $array_with_links

            ];

            $response = $client->SendApplication($dat); // ответ от 1с
            Log::info('[WTF]', [$response]);
            // Удаление всех приложений
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
