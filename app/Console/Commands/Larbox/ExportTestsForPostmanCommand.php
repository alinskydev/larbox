<?php

namespace App\Console\Commands\Larbox;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Output\StreamOutput;

class ExportTestsForPostmanCommand extends Command
{
    protected $signature = 'larbox:export_tests_for_postman';

    protected $description = 'Export tests for postman';

    public function handle(): void
    {
        // Preparing input file

        $collectionName = $this->ask('Enter collectioin name', config('app.name'));

        $path = base_path('storage/larbox/tests');

        if (!is_dir($path)) {
            $this->error("'$path' doesn't exists");
            die;
        }

        $inputFileName = "$path/_postman.json";
        File::delete($inputFileName);

        $stream = fopen('php://output', 'w');
        Artisan::call('larbox:test', [], new StreamOutput($stream));

        // Preparing data

        $inputData = file_get_contents($inputFileName);
        $inputData = json_decode($inputData, true);
        $inputData = Arr::undot($inputData);

        $outputData = [
            'info' => [
                'name' => $collectionName,
                'schema' => 'https://schema.getpostman.com/json/collection/v2.1.0/collection.json',
            ],
            'variable' => [
                [
                    'key' => 'host',
                    'value' => url('/'),
                    'type' => 'string',
                ],
            ],
            'item' => $this->addItems($inputData),
        ];

        // Saving data

        $outputData = json_encode($outputData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        $collectionName = Str::slug($collectionName) . '_' . date('Y_m_d__H_i_s') . '_collection.json';
        $outputFileName = "$path/$collectionName";

        file_put_contents($outputFileName, $outputData);
        File::delete($inputFileName);

        $this->line("File: $outputFileName");
    }

    private function addItems(array $items): array
    {
        $data = [];

        foreach ($items as $name => $item) {
            if (isset($item['is_request'])) {
                $jsonOptions = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT;

                $request = $item['request'];
                $response = $item['response'];

                $formdata = [];

                $formdata[] = Arr::map($request['body'], fn ($value, $key) => [
                    'key' => $key,
                    'type' => 'text',
                    'value' => $value,
                ]);

                if ($request['files']) {
                    $formdata[] = Arr::map($request['files'], fn ($value, $key) => [
                        'key' => $key,
                        'type' => 'file',
                        'src' => $value,
                    ]);
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
                    'header' => Arr::map($response['headers'], fn ($value, $key) => [
                        'key' => $key,
                        'value' => $value,
                    ]),
                    'body' => $response['body'] ? json_encode($response['body'], $jsonOptions) : null,
                    'originalRequest' => [
                        'method' => $request['method'],
                        'header' => Arr::map($request['headers'], fn ($value, $key) => [
                            'key' => $key,
                            'value' => $value,
                        ]),
                        'body' => $requestBody,
                        'url' => [
                            'host' => ['{{host}}'],
                            'raw' => '{{host}}/' . $request['url']['raw'],
                            'path' => explode('/', $request['url']['path']),
                            'query' => Arr::map($request['url']['query'], fn ($value, $key) => [
                                'key' => $key,
                                'value' => $value,
                            ]),
                        ],
                    ],
                ];
            } elseif (isset(current($item)['is_request'])) {
                $request = current($item)['request'];

                $data[] = [
                    'name' => implode(' ', Str::ucsplit($name)),
                    'request' => [
                        'method' => $request['method'],
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
