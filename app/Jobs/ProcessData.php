<?php


namespace App\Jobs;

use App\Models\Dataset;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ProcessData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $csvFilePath;

    /**
     * Create a new job instance.
     *
     * @param string $csvFilePath
     */
    public function __construct(string $csvFilePath)
    {
        $this->csvFilePath = $csvFilePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $filePath = $this->csvFilePath;

        $file = Storage::disk('local')->get($filePath);
        $lines = explode("\n", $file);
        $header = str_getcsv(array_shift($lines));

        foreach ($lines as $line) {
            $row = str_getcsv($line);
            $data = array_combine($header, $row);

            if ($data) {
                $existingRecord = Dataset::where('email', $data['email'])->first();
                if ($existingRecord) {
                    continue;
                }

                Dataset::create($data);
            }
        }
    }
}
