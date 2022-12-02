<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Base\Model;
use Illuminate\Support\Facades\Schema;

class ParseFields extends Command
{
    protected $signature = 'larbox:parse_fields';

    protected $description = 'Parse fields';

    public function handle(): void
    {
        //  Checking folder existance

        $basePath = base_path();
        $path = "$basePath/storage/larbox/localization";

        if (!is_dir($path)) {
            $this->error("'$path' doesn't exists"); die;
        }

        // Parsing form requests

        $fields = [];

        $files = array_merge(
            glob("$basePath/http/*/Requests/*.php"),
            glob("$basePath/http/*/Requests/*/*.php"),
            glob("$basePath/http/*/*/Requests/*.php"),
            glob("$basePath/http/*/*/Requests/*/*.php"),
        );

        foreach ($files as $file) {
            $file = str_replace([$basePath, '.php'], '', $file);
            $file = str_replace('/', '\\', $file);
            $file = str_replace('http', 'Http', $file);

            $attributes = array_values($this->formAttributes($file));
            $attributes = array_map(fn ($value) => preg_replace('/^fields./', '', $value), $attributes);

            $fields = array_merge($fields, $attributes);
        }

        // Parsing models

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
        $outputFileName = "$path/" . date('Y_m_d__H_i_s') . '_fields.php';

        file_put_contents($outputFileName, $outputData);

        $this->line('File:');
        $this->line($outputFileName);
        $this->line('Folder:');
        $this->line($path);
    }

    private function formAttributes(string $formRequestClass): array
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
