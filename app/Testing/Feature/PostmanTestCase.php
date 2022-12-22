<?php

namespace App\Testing\Feature;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Testing\File;

use App\Testing\Feature\Traits\ActionFeatureTestTrait;

abstract class PostmanTestCase extends BaseTestCase
{
    use CreatesApplicationTrait;
    use ActionFeatureTestTrait;

    public const REQUEST_METHOD_GET = 'GET';
    public const REQUEST_METHOD_POST = 'POST';
    public const REQUEST_METHOD_PUT = 'PUT';
    public const REQUEST_METHOD_PATCH = 'PATCH';
    public const REQUEST_METHOD_DELETE = 'DELETE';
    public const REQUEST_METHOD_OPTIONS = 'OPTIONS';
    public const REQUEST_METHOD_HEAD = 'HEAD';

    protected $defaultHeaders = [
        'Accept' => 'application/json',
        'Accept-Language' => 'ru',
    ];

    public string $requestUrl;
    public string $requestMethod;
    public array $requestQuery = [];
    private string $requestQueryAsString;

    public array $requestBody = [];
    private array $requestFiles = [];

    protected array $requestHeaders = [];
    protected array $authHeaders = [];
    private array $allRequestHeaders = [];

    public TestResponse $response;

    public function sendRequest(): TestResponse
    {
        if (in_array($this->requestMethod, [self::REQUEST_METHOD_PUT, self::REQUEST_METHOD_PATCH])) {
            $this->requestQuery['_method'] = $this->requestMethod;
            $this->requestMethod = self::REQUEST_METHOD_POST;
        }

        $this->requestQueryAsString = http_build_query($this->requestQuery);

        $this->allRequestHeaders = array_merge($this->defaultHeaders, $this->requestHeaders, $this->authHeaders);

        return $this->call(
            method: $this->requestMethod,
            uri: $this->requestQueryAsString ? "$this->requestUrl?$this->requestQueryAsString" : $this->requestUrl,
            parameters: $this->requestBody,
            server: $this->transformHeadersToServerVars($this->allRequestHeaders),
        );
    }

    public function callBeforeApplicationDestroyedCallbacks(): void
    {
        // Collecting

        $this->requestQuery = Arr::dot($this->requestQuery);
        $this->requestBody = Arr::dot($this->requestBody);

        foreach ($this->requestBody as $key => &$value) {
            if ($value instanceof File) {
                $this->requestFiles[$key] = $value->name;
                unset($this->requestBody[$key]);
            }
        }

        $this->requestQuery = $this->convertDataToSingleDimensionalArray($this->requestQuery);
        $this->requestBody = $this->convertDataToSingleDimensionalArray($this->requestBody);
        $this->requestFiles = $this->convertDataToSingleDimensionalArray($this->requestFiles);

        // Getting target

        $target = $this->providedTests[0]->getTarget();

        $target = preg_replace('/^Http\\\|Tests\\\|Test|test_/', '', $target);
        $target = str_replace(['\\', '::'], '.', $target);
        $target = str_replace('___', ' | ', $target);

        // Saving to file

        $fileName = base_path('storage/larbox/tests/_postman.json');
        $items = is_file($fileName) ? file_get_contents($fileName) : '[]';
        $items = json_decode($items, true);

        $items[$target] = [
            'is_request' => true,
            'request' => [
                'headers' => $this->allRequestHeaders,
                'body' => $this->requestBody,
                'files' => $this->requestFiles,
                'method' => $this->requestMethod,
                'url' => [
                    'path' => $this->requestUrl,
                    'query' => $this->requestQuery,
                    'raw' => $this->requestQueryAsString ? "$this->requestUrl?$this->requestQueryAsString" : $this->requestUrl,
                ],
            ],
            'response' => [
                'headers' => $this->response->baseResponse->headers->allPreserveCase(),
                'body' => json_decode($this->response->baseResponse->content(), true),
                'status' => [
                    'code' => $this->response->baseResponse->status(),
                    'text' => $this->response->baseResponse->statusText(),
                ],
            ],
        ];

        $items = json_encode($items, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        file_put_contents($fileName, $items);

        parent::callBeforeApplicationDestroyedCallbacks();
    }

    private function convertDataToSingleDimensionalArray(array $data): array
    {
        $result = Arr::map($data, function ($value, $key) {
            $key = Str::replaceFirst('.', '[', $key);
            $key = str_replace('.', '][', $key);
            $key = str_contains($key, '[') ? "$key]" : $key;

            return [
                'key' => $key,
                'value' => (string)$value,
            ];
        });
        
        $result = Arr::pluck($result, 'value', 'key');

        return $result;
    }
}
