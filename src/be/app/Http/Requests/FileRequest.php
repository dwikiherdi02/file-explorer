<?php

namespace App\Http\Requests;

use App\Models\Directory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class FileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function storeRules(): array
    {
        return [
            'parent_id' => ['bail', 'required', Rule::exists(Directory::class, 'id')],
        ];
    }

    public function fileDocRules(): array
    {
        return [
            'file' => ['required', 'file', 'mimes:docx,doc,pdf', 'max:1000'],
        ];
    }

    public function fileMusRules(): array
    {
        return [
            'file' => ['required', 'file', 'mimes:mp3', 'max:1000'],
        ];
    }

    public function fileImgRules(): array
    {
        return [
            'file' => ['required', 'file', 'mimes:jpg,png', 'max:1000'],
        ];
    }

    public function fileVidRules(): array
    {
        return [
            'file' => ['required', 'file', 'mimes:mp4', 'max:1000'],
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function getRules(string $type = 'store'): array
    {
        $rules = [];

        switch ($type) {
            case 'store':
                $rules = $this->storeRules();
                break;

            case 'docRules':
                $rules = $this->fileDocRules();
                break;

            case 'musRules':
                $rules = $this->fileMusRules();
                break;

            case 'imgRules':
                $rules = $this->fileImgRules();
                break;

            case 'vidRules':
                $rules = $this->fileVidRules();
                break;

            default:
                # code...
                break;
        }
        return $rules;
    }

    public function validating(string $type = 'store'): array|null
    {
        $errors = [];
        $validator = Validator::make($this->all(), $this->getRules($type));

        if ($validator->fails()) {
            $errors = $validator->messages()->get('*');
            $mappedErr = Arr::map($errors, function (array $value) {
                return Arr::first($value);
            });
            $errors = $mappedErr;
            return $errors;
        }
        return null;
    }
}
