<?php

namespace App\Console\Commands\Larbox;

use Illuminate\Console\Command;
use App\Helpers\ClassHelper;
use App\Base\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Arr;
use Modules\User\Models\User;

class ParseFieldsCommand extends Command
{
    protected $signature = 'larbox:parse_fields';

    protected $description = 'Parse fields';

    public function handle(): void
    {
        $path = base_path('storage/larbox/localization');

        if (!is_dir($path)) {
            $this->error("'$path' doesn't exists");
            die;
        }

        $fields = [
            ...$this->parseFormRequestsAttributes(),
            ...$this->parseDatabaseColumns(),
        ];

        $fields = array_unique($fields);
        sort($fields);

        $outputData = [
            "<?php\n",
            'return [',
            ...array_map(fn ($field) => "\t'$field' => '',", $fields),
            "];\n",
        ];

        $outputData = implode("\n", $outputData);
        $outputFileName = "$path/" . date('Y_m_d__H_i_s') . '_fields.php';

        file_put_contents($outputFileName, $outputData);

        $this->line("File: $outputFileName");
    }

    private function parseFormRequestsAttributes(): array
    {
        $emptyModel = new Model();

        $basePath = base_path();

        $files = array_merge(
            glob("$basePath/http/*/Requests/*.php"),
            glob("$basePath/http/*/Requests/*/*.php"),
            glob("$basePath/http/*/*/Requests/*.php"),
            glob("$basePath/http/*/*/Requests/*/*.php"),
        );

        $fields = array_map(function ($file) use ($emptyModel) {
            $user = User::query()->find(1);
            request()->setUserResolver(fn () => $user);

            try {
                $file = ClassHelper::classByFile($file);
                $formRequestReflection = new \ReflectionClass($file);

                /** @var object */
                $formRequest = $formRequestReflection->newInstanceWithoutConstructor();
                $formRequest->model = $emptyModel;
                $formRequest->__construct();

                $attributes = array_values($formRequest->attributes());
                $attributes = array_map(fn ($value) => preg_replace('/^fields\./', '', $value), $attributes);

                return $attributes;
            } catch (\Throwable $e) {
                echo 'Error: ' . $e->getMessage() . " ($file)" . "\n";
                return [];
            }
        }, $files);

        return array_merge(...$fields);
    }

    private function parseDatabaseColumns(): array
    {
        $tables = Schema::getAllTables();
        $tables = Arr::pluck($tables, 'tablename');

        $fields = array_map(fn ($table) => Schema::getColumnListing($table), $tables);

        return array_merge(...$fields);
    }
}
