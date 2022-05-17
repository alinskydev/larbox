<?php

namespace Modules\User\Http\Public\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\User\Models\UserMessage;

use Illuminate\Validation\Rule;
use App\Helpers\FormRequestHelper;

class UserMessageRequest extends ActiveFormRequest
{
    protected array $fileFields = [
        'files_list' => 'files',
    ];

    public function __construct()
    {
        return parent::__construct(
            model: new UserMessage()
        );
    }

    public function rules()
    {
        return [
            'text' => 'required_without:files_list|string|max:4096',

            'files_list' => 'array',
            'files_list.*' => 'required_without:text|file|max:10240|mimes:jpg,png,webp,doc,docx,xls,pdf',
        ];
    }
}
