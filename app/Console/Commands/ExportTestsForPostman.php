<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Output\StreamOutput;

class ExportTestsForPostman extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larbox:export_tests_for_postman';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export tests for postman';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Preparing input file

        $collectionName = $this->ask('Enter collectioin name', config('app.name'));

        $inputFileName = base_path('larbox/storage/tests/_postman.json');
        File::delete($inputFileName);

        $stream = fopen('php://output', 'w');
        Artisan::call("migrate:fresh --seed", [], new StreamOutput($stream));
        Artisan::call("test", [], new StreamOutput($stream));

        // Preparing data

        $inputData = file_get_contents($inputFileName);
        $inputData = json_decode($inputData, true);

        $outputData = [
            'info' => [
                'name' => $collectionName,
                'schema' => 'https://schema.getpostman.com/json/collection/v2.1.0/collection.json',
            ],
            'variable' => [
                [
                    'key' => 'host',
                    'value' => Arr::pull($inputData, 'host'),
                    'type' => 'string',
                ],
            ],
        ];

        // Parsing data

        $inputData = Arr::undot($inputData);

        $outputData['item'] = $this->addItems($inputData);

        // Saving data

        $outputData = json_encode($outputData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        $outputFileName = Str::slug($collectionName);
        $outputFileName = base_path('larbox/storage/tests/' . date('Y_m_d_His') . "_{$outputFileName}_collection.json");

        file_put_contents($outputFileName, $outputData);
        File::delete($inputFileName);

        $this->info("Output file is store in: $outputFileName");
    }

    private function addItems(array $items)
    {
        $data = [];

        foreach ($items as $name => $item) {
            if (isset($item['is_request'])) {
                $jsonOptions = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT;

                $request = $item['request'];
                $response = $item['response'];

                $formdata = [];

                $formdata[] = array_map(function ($value, $key) {
                    return [
                        'key' => $key,
                        'type' => 'text',
                        'value' => $value,
                    ];
                }, $request['body'], array_keys($request['body']));

                if ($request['files']) {
                    $formdata[] = array_map(function ($value, $key) {
                        return [
                            'key' => $key,
                            'type' => 'file',
                            'src' => $value,
                        ];
                    }, $request['files'], array_keys($request['files']));
                }

                $formdata = array_merge(...$formdata);
                $formdata = Arr::sort($formdata, 'key');
                $formdata = array_values($formdata);

                $requestBody = [
                    'mode' => 'formdata',
                    'formdata' => $formdata,
                ];

                $data[] = [
                    '_postman_previewlanguage' => 'json',
                    'name' => ucfirst(str_replace('_', ' ', $name)),
                    'status' => $response['status']['text'],
                    'code' => $response['status']['code'],
                    'header' => array_map(function ($value, $key) {
                        return [
                            'key' => $key,
                            'value' => $value,
                        ];
                    }, $response['headers'], array_keys($response['headers'])),
                    'body' => $response['body'] ? json_encode($response['body'], $jsonOptions) : null,
                    'originalRequest' => [
                        'method' => $request['method'],
                        'header' => array_map(function ($value, $key) {
                            return [
                                'key' => $key,
                                'value' => $value,
                            ];
                        }, $request['headers'], array_keys($request['headers'])),
                        'body' => $requestBody,
                        'url' => [
                            'host' => ['{{host}}'],
                            'raw' => '{{host}}/' . $request['url']['raw'],
                            'path' => explode('/', $request['url']['path']),
                            'query' => array_map(function ($value, $key) {
                                return [
                                    'key' => $key,
                                    'value' => $value,
                                ];
                            }, $request['url']['query'], array_keys($request['url']['query'])),
                        ],
                    ],
                ];
            } elseif (isset(current($item)['is_request'])) {
                $request = current($item)['request'];

                $data[] = [
                    'name' => implode(' ', Str::ucsplit($name)),
                    'request' => [
                        'method' => $request['method'],
                        'header' => $request['headers'],
                        'body' => ['mode' => 'none'],
                    ],
                    'response' => $this->addItems($item),
                ];
            } else {
                $data[] = [
                    'name' => implode(' ', Str::ucsplit($name)),
                    'item' => $this->addItems($item),
                ];
            }
        }

        return $data;
    }
}
