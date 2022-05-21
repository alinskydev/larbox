<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ParseAndroidLocalizationMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larbox:parse_android_localization_messages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse android localization messages';

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

        //  Checking input file existance

        $inputFileName = "$path/_android_messages.xml";

        if (!is_file($inputFileName)) {
            return $this->error("'$inputFileName' not found");
        }

        // Parsing data

        $inputData = file_get_contents($inputFileName);
        $inputData = new \SimpleXMLElement($inputData);

        $fields = [];

        foreach ($inputData->xpath('/resources/string') as $string) {
            $fieldKey = $this->xmlAttribute($string, 'name');
            $fields[$fieldKey] = $string->__toString();
        }

        $fields = array_unique($fields);

        ksort($fields);

        $outputData = [];
        $outputData[] = '<?php';
        $outputData[] = '';
        $outputData[] = 'return [';

        foreach ($fields as $field => $value) {
            $outputData[] = "\t'$field' => '$value',";
        }

        $outputData[] = '];';
        $outputData[] = '';

        // Saving data

        $outputData = implode("\n", $outputData);
        $outputFileName = "$path/" . date('Y_m_d_His') . '_android_localization_messages.php';

        file_put_contents($outputFileName, $outputData);
        $this->info("Output file is store in: $outputFileName");
    }

    public static function xmlAttribute($xml, $attribute)
    {
        return isset($xml[$attribute]) ? (string)$xml[$attribute] : null;
    }
}
