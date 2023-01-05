<?php

namespace App\Testing\Feature\Traits;

use App\Testing\Feature\Helpers\FormHelper;

trait ActionFeatureTestTrait
{
    public string $formHelper = FormHelper::class;

    public function processShow(string $path = '1', int $assertStatus = 200): void
    {
        $this->processCall(
            path: $path,
            method: 'GET',
            body: [],
            assertStatus: $assertStatus,
        );
    }

    public function processUpdate(string $path = '1', array $body = [], int $assertStatus = 200): void
    {
        $this->processCall(
            path: $path,
            method: 'PUT',
            body: $body,
            assertStatus: $assertStatus,
        );
    }

    public function processDelete(string $path = '2', int $assertStatus = 200): void
    {
        $this->processCall(
            path: $path,
            method: 'DELETE',
            body: [],
            assertStatus: $assertStatus,
        );
    }

    public function processRestore(string $path = '2/restore', int $assertStatus = 200): void
    {
        $this->processCall(
            path: $path,
            method: 'DELETE',
            body: [],
            assertStatus: $assertStatus,
        );
    }

    public function processPost(string $path = '', array $body = [], int $assertStatus = 200): void
    {
        $this->processCall(
            path: $path,
            method: 'POST',
            body: $body,
            assertStatus: $assertStatus,
        );
    }

    public function processPatch(string $path, array $body = [], int $assertStatus = 200): void
    {
        $this->processCall(
            path: $path,
            method: 'PATCH',
            body: $body,
            assertStatus: $assertStatus,
        );
    }

    public function processCall(string $path, string $method, array $body = [], int $assertStatus = 200): void
    {
        $this->requestUrl .= $path ? "/$path" : '';
        $this->requestMethod = $method;
        $this->requestBody = $body;

        $this->response = $this->sendRequest();
        $this->response->assertStatus($assertStatus);
    }
}
