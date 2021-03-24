<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TweetRequest extends FormRequest
{
    public const FIELD_TEXT = 'text';
    public const FIELD_IMAGE = 'image';
    public const FIELD_MEDIA_UPLOAD_TYPE = 'media-upload-type';

    public const MEDIA_UPLOAD_TYPE_SIMPLE = 'simple';
    public const MEDIA_UPLOAD_TYPE_BASE_64 = 'base64';
    public const MEDIA_UPLOAD_TYPE_CHUNKED = 'chunked';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            self::FIELD_TEXT => 'string|max:280',
            self::FIELD_IMAGE => 'image|nullable',
            self::FIELD_MEDIA_UPLOAD_TYPE => sprintf(
                "in:%s,%s,%s",
                self::MEDIA_UPLOAD_TYPE_SIMPLE,
                self::MEDIA_UPLOAD_TYPE_BASE_64,
                self::MEDIA_UPLOAD_TYPE_CHUNKED
            ),
        ];
    }
}
