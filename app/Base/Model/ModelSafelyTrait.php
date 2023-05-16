<?php

namespace App\Base\Model;

use Illuminate\Support\Facades\DB;

trait ModelSafelyTrait
{
    public function safelySave(array $attributes = []): void
    {
        $this->safelyDBProcess(function () use ($attributes) {
            $this->fill($attributes);
            $this->usesTimestamps() ? $this->touch() : $this->save();
        });
    }

    public function safelyDelete(): void
    {
        $this->safelyDBProcess(function () {
            $this->delete();
        });
    }

    public function safelyRestore(): void
    {
        $this->safelyDBProcess(function () {
            $this->restore();
        });
    }

    public function safelyDBProcess(callable $callback): void
    {
        if (DB::transactionLevel() > 0) {
            $callback();
            return;
        }

        DB::beginTransaction();

        try {
            $callback();
        } catch (\Throwable $e) {
            DB::rollBack();
            abort(400, $e->getMessage());
        }

        DB::commit();
    }
}
