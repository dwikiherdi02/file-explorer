<?php

namespace App\Http\Requests;

use App\Models\Directory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class DirectoryRequest extends FormRequest
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
            'folder_name' => ['bail', 'required', 'regex:/^[\w\-\s\.]+$/'],
        ];
    }

    public function listRules(): array
    {
        return [
            // 'rid' => ['bail', 'required', Rule::exists(Directory::class, 'root_id')],
            'rid' => ['bail', 'required'],
            'subid' => ['bail', Rule::exists(Directory::class, 'id')],
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

            case 'list':
                $rules = $this->listRules();
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
