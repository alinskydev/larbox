<?php

namespace Http\Admin\Box\Requests;

use App\Http\Requests\ActiveFormRequest;

class TagRequest extends ActiveFormRequest
{
    public function nonLocalizedRules()
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }
}
