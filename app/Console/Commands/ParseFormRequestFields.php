<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Model;
use Illuminate\Support\Facades\Schema;

class ParseFormRequestFields extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larbox:parse_fields';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse fields';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //  Checking folder existance

        $path = base_path('storage/larbox/localization');

        if (!is_dir($path)) {
            return $this->error("'$path' doesn't exists");
        }

        // Parsing form requests

        $fields = [];

        $basePath = base_path();
        $files = glob("$basePath/http/*/*/Requests/*.php");

        foreach ($files as $file) {
            $file = str_replace([$basePath, '.php'], '', $file);
            $file = str_replace('/', '\\', $file);
            $file = str_replace('http', 'Http', $file);

            $attributes = array_keys($this->formAttributes($file));

            $fields = array_merge($fields, $attributes);
        }

        // Parsing tables

        $files = glob("$basePath/modules/*/Models/*.php");

        foreach ($files as $file) {
            $file = str_replace([$basePath, '.php'], '', $file);
            $file = str_replace('/', '\\', $file);
            $file = str_replace('modules', 'Modules', $file);

            $table = (new $file())->getTable();
            $attributes = Schema::getColumnListing($table);

            $fields = array_merge($fields, $attributes);
        }

        // Preparing to save

        $fields = array_unique($fields);

        sort($fields);

        $outputData = [];
        $outputData[] = '<?php';
        $outputData[] = '';
        $outputData[] = 'return [';

        foreach ($fields as $field) {
            $outputData[] = "\t'$field' => '',";
        }

        $outputData[] = '];';
        $outputData[] = '';

        // Saving

        $outputData = implode("\n", $outputData);
        $outputFileName = "$path/" . date('Y_m_d_His') . '_form_request_fields.php';

        file_put_contents($outputFileName, $outputData);
        $this->info("Output file is store in: $outputFileName");
    }

    private function formAttributes(string $formRequestClass)
    {
        try {
            $formRequestReflection = new \ReflectionClass($formRequestClass);
            $formRequest = $formRequestReflection->newInstanceWithoutConstructor();
            $formRequest->model = new Model();
            $formRequest->__construct();

            return $formRequest->attributes();
        } catch (\Throwable $e) {
            $this->error("$formRequestClass hasn't been parsed");
            return [];
        }
    }
}
