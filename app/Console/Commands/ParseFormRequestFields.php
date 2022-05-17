<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ParseFormRequestFields extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sr:parse_form_request_fields';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse FormRequest fields';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //  Checking folder existance

        $path = base_path('sr/localization');

        if (!is_dir($path)) {
            return $this->error("'$path' doesn't exists");
        }

        // Parsing data
        
        $fields = [];
        
        $basePath = base_path();
        $files = glob("$basePath/modules/*/Http/*/Requests/*.php");
        
        foreach ($files as $file) {
            $file = str_replace([$basePath, '.php'], '', $file);
            $file = str_replace('/', '\\', $file);
            $file = str_replace('modules', 'Modules', $file);
            
            $formRequest = new $file();
            $attributes = array_keys($formRequest->attributes());
            
            $fields = array_merge($fields, $attributes);
        }
        
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

        // Saving data

        $outputData = implode("\n", $outputData);
        $outputFileName = "$path/" . date('Y_m_d_His') . '_form_request_fields.php';

        file_put_contents($outputFileName, $outputData);
        $this->info("Output file is store in: $outputFileName");
    }
}
