<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

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
        //  Checking folder existance

        $path = base_path('storage/larbox/tests');

        if (!is_dir($path)) {
            return $this->error("'$path' doesn't exists");
        }
        
        //  Checking input file existance
        
        $inputFileName = "$path/_postman.json";

        if (!is_file($inputFileName)) {
            return $this->error("'$inputFileName' not found");
        }

        $collectionName = $this->ask('Enter collectioin name', 'unnamed');

        // Preparing data

        $inputData = file_get_contents($inputFileName);
        $inputData = json_decode($inputData, true);

        $outputData = [
            'info' => [
                'name' => $collectionName,
                'schema' => 'https://schema.getpostman.com/json/collection/v2.1.0/collection.json',
            ],
            'event' => [
                [
                    'listen' => 'prerequest',
                    'script' => [
                        'type' => 'text/javascript',
                        'exec' => [
                            "var Header = require('postman-collection').Header;",
                            "pm.request.headers.add(new Header('Accept: application/json'));",
                            "// pm.request.headers.add(new Header('API-Type: admin'));",
                            "// pm.request.headers.add(new Header('API-Type: public'));",
                        ],
                    ],
                ],
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
        $outputFileName = "$path/" . date('Y_m_d_His') . "_{$outputFileName}_collection.json";

        file_put_contents($outputFileName, $outputData);
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

                if ($request['files']) {
                    $formdata = [];

                    $formdata[] = array_map(function ($value, $key) {
                        return [
                            'key' => $key,
                            'type' => 'text',
                            'value' => $value,
                        ];
                    }, $request['body'], array_keys($request['body']));

                    $formdata[] = array_map(function ($value, $key) {
                        return [
                            'key' => $key,
                            'type' => 'file',
                            'src' => $value,
                        ];
                    }, $request['files'], array_keys($request['files']));

                    $requestBody = [
                        'mode' => 'formdata',
                        'formdata' => array_merge(...$formdata),
                    ];
                } else {
                    if ($request['body']) {
                        $requestBody = [
                            'mode' => 'raw',
                            'raw' => json_encode($request['body'], $jsonOptions),
                            'options' => [
                                'raw' => [
                                    'language' => 'json',
                                ],
                            ],
                        ];
                    } else {
                        $requestBody = ['mode' => 'none'];
                    }
                }

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
                        'header' => $request['headers'],
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
                        'url' => [
                            'host' => ['{{host}}'],
                            'raw' => '{{host}}/' . $request['url']['path'],
                            'path' => explode('/', $request['url']['path']),
                        ],
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
