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
        try {
            $client = new SoapClient(config('app.address_1c'), array("trace" => false, "exceptions" => true, 'cache_wsdl' => WSDL_CACHE_NONE)); //для 1с
            $formData = [
                $this->application->Surname,
                $this->application->Name,
                $this->application->Patronymic,
                $this->application->Sex,
                $this->application->Birthday,
                $this->application->Birthplace,
                $this->application->Languages,
                $this->application->AcademicDegree,
                $this->application->ScientificWork,
                $this->application->MilitaryRank,
                $this->application->MilitaryComposition,
                $this->application->MilitaryBranch,
                $this->application->HomeAddress,
                $this->application->Phone,
                $this->application->PassportSeries,
                $this->application->PassportNumber,
                $this->application->PassportGiven,
                $this->application->Inn,
                $this->application->Pfr,
                $this->application->Biography,
                Storage::url($this->application->avatar),
                $this->application->candidate()->first()->email];

            $DataEducation = [];
            foreach ($this->application->education_data as $education) {
                $DataEducation[] = [
                    $education->institution,
                    $education->faculty,
                    $education->formStudy,
                    $education->admissionYear,
                    $education->graduationYear,
                    $education->graduationCourse,
                    $education->specialty,
                    $education->diploma,
                    $education->candidate_id];
            }

            $DataWork = [];
            foreach ($this->application->work_data as $work) {
                $DataWork[] = [
                    $work->entry,
                    $work->exit,
                    $work->position,
                    $work->location,
                    $work->candidate_id];
            }
            $DataAbroad = [];
            foreach ($this->application->abroad_data as $abroad) {
                $DataAbroad[] = [
                    $abroad->sinceTime,
                    $abroad->atTime,
                    $abroad->country,
                    $abroad->goal,
                    $abroad->candidate_id];
            }
            $DataAward = [];
            foreach ($this->application->award_data as $award) {
                $DataAward[] = [
                    $award->data,
                    $award->reward,
                    $award->candidate_id];
            }

            $DataFamily = [];
            foreach ($this->application->family_data as $family) {
                $DataFamily[] = [
                    $family->name,
                    $family->surname,
                    $family->patronymic,
                    $family->birthday,
                    $family->telephone,
                    $family->candidate_id
                ];
            }

            $DataFiles = [];
            foreach ($this->application->addictions()->get() as $file) {
                $url = Storage::url($file->file);
                $desc = $file->description;
                $extension = substr(strrchr($url, '.'), 1);
                $DataFiles[] = [
                    $url,
                    $desc,
                    $extension
                ];
            }

            $domen = config('app.url');
//            $avatar = /**/
            $datas = array(
                "formData" => $formData,
                "DataEducation" => $DataEducation,
                "DataWork" => $DataWork,
                "DataAbroad" => $DataAbroad,
                "DataAward" => $DataAward,
                "DataFamily" => $DataFamily,
                "DataFiles" => $DataFiles,
                "domen" => $domen);

//            dd(config('app.address_1c'));
            $response = $client->SendApplication($datas); // ответ от 1с
            Log::info('[ERROR]', [$response]);
            if (!empty($response)) {
                $this->application->candidate()->update(['uncial_id' => $response->return, 'status' => 'Отправлено в отдел кадров']); //Возвращает уникальную ссылку на запись
                Storage::delete($this->application->avatar);
                $addictions = $this->application->addictions()->get();
                foreach ($addictions as $addiction) {
                    // тут можно обработать все приложения перед удалением
                    Storage::delete($addiction->file);
                }
                $this->application->forceDelete();
                $this->delete();
            } else {
                throw new Exception('Ошибка отправки данных в 1С.', 500);
            }
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