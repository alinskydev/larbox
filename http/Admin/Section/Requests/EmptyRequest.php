<?php

namespace Http\Admin\Section\Requests;

use Modules\Section\Base\FormRequest;
use Modules\Seo\Traits\SeoMetaFormRequestTrait;

class EmptyRequest extends FormRequest
{
    use SeoMetaFormRequestTrait;
}
