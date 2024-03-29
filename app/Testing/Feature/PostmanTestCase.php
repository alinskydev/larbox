<?php

namespace App\Testing\Feature;

use App\Testing\CreatesApplicationTrait;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Testing\File;
use Modules\User\Models\User;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PostmanTestCase extends BaseTestCase
{
    use CreatesApplicationTrait;
    use DatabaseTransactions;

    public int $userId;

    protected array $requestHeaders = [];
    protected $defaultHeaders = [
        'Accept' => 'application/json',
        'Accept-Language' => 'ru',
    ];

    private array $allRequestHeaders = [];

    private string $requestMethod;
    public string $requestUrl;
    private array $requestQuery = [];
    private string $requestQueryAsString;

    private array $requestBody = [];
    private array $requestFiles = [];

    public TestResponse $response;

    protected function setUp(): void
    {
        parent::setUp();

        if (isset($this->userId)) {
            $this->authAsUser($this->userId);
        }
    }

    protected function authAsUser(int $userId): void
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable */
        $user = User::query()->findOrFail($userId);
        request()->setUserResolver(fn () => $user);
        $this->actingAs($user, 'sanctum');
    }

    public function sendRequest(
        string $method = 'GET',
        string $path = '',
        array $query = [],
        array $body = [],
        int $assertStatus = 200,
    ): void {
        $this->requestMethod = $method;
        $this->requestUrl .= $path ? "/$path" : '';
        $this->requestQuery = $query;
        $this->requestBody = $body;

        $this->response = $this->sendRequestAndPrepareData();

        try {
            $this->response->assertStatus($assertStatus);
        } catch (\Throwable $e) {
            $response = $this->response->baseResponse;

            $content = $response->getContent();
            $content = json_encode(json_decode($content), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            $response->setContent($content);

            throw new \Exception($response);
        }
    }

    private function sendRequestAndPrepareData(): TestResponse
    {
        if (in_array($this->requestMethod, ['PUT', 'PATCH'])) {
            $this->requestQuery['_method'] = $this->requestMethod;
            $this->requestMethod = 'POST';
        }

        $this->requestQueryAsString = http_build_query($this->requestQuery);

        $this->allRequestHeaders = array_merge($this->defaultHeaders, $this->requestHeaders);

        if (isset($this->userId)) {
            $this->allRequestHeaders['Authorization'] = '<TOKEN>';
        }

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

        $this->requestBody = Arr::dot($this->requestBody);

        foreach ($this->requestBody as $key => $value) {
            if ($value instanceof File) {
                $this->requestFiles[$key] = $value->name;
                unset($this->requestBody[$key]);
            }
        }

        $this->requestQuery = $this->prepareHttpQuery($this->requestQuery);
        $this->requestBody = $this->convertDataToSingleDimensionalArray($this->requestBody);
        $this->requestFiles = $this->convertDataToSingleDimensionalArray($this->requestFiles);

        // Getting target

        $target = $this->provides()[0]->getTarget();

        $targetPath = preg_replace('/^Http\\\|Tests\\\|Test|test_/', '', $target);
        $targetPath = str_replace(['\\', '::'], '.', $targetPath);
        $targetPath = str_replace('___', ' | ', $targetPath);

        $targetArr = explode('::', $target);
        $targetClass = new \ReflectionClass($targetArr[0]);

        $comment = explode("\n", $targetClass->getDocComment());
        $comment = array_map(fn ($value) => ltrim($value, '/* '), $comment);
        $comment = implode("\n", $comment);
        $comment = trim($comment);

        // Preparing data

        $fileName = base_path('storage/larbox/tests/_postman.json');
        $items = is_file($fileName) ? file_get_contents($fileName) : '[]';
        $items = json_decode($items, true);

        $baseResponse = $this->response->baseResponse;

        if ($baseResponse instanceof StreamedResponse) {
            $responseData = [
                'headers' => $baseResponse->headers->allPreserveCase(),
                'body' => 'Binary data',
                'status' => [
                    'code' => 200,
                    'text' => 'OK',
                ],
            ];
        } else {
            $responseData = [
                'headers' => $baseResponse->headers->allPreserveCase(),
                'body' => json_decode($baseResponse->content(), true),
                'status' => [
                    'code' => $baseResponse->status(),
                    'text' => $baseResponse->statusText(),
                ],
            ];
        }

        $items[$targetPath] = [
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
            'response' => $responseData,
            'comment' => $comment,
        ];

        // Saving to file

        $items = json_encode($items, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        file_put_contents($fileName, $items);

        parent::callBeforeApplicationDestroyedCallbacks();
    }

    private function prepareHttpQuery(array $query): array
    {
        if (!$query) return [];

        $query = http_build_query($query);
        $query = urldecode($query);
        $query = explode('&', $query);

        $query = array_map(function ($value) {
            $value = explode('=', $value);

            return [
                'key' => $value[0],
                'value' => $value[1],
            ];
        }, $query);

        $query = Arr::pluck($query, 'value', 'key');

        return $query;
    }

    private function convertDataToSingleDimensionalArray(array $data): array
    {
        $result = Arr::map($data, function ($value, $key) {
            $key = Str::replaceFirst('.', '[', $key);
            $key = str_replace('.', '][', $key);
            $key = str_contains($key, '[') ? "$key]" : $key;

            return [
                'key' => $key,
                'value' => is_array($value) ? '{{empty_array}}' : (string)$value,
            ];
        });

        $result = Arr::pluck($result, 'value', 'key');

        return $result;
    }
}
