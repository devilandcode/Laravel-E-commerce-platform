<?php

namespace App\Http\Requests\Banner;

use App\Entity\Banner\Banner;
use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        [$width, $height] = [0, 0];
        if ($format = $this->input('format')) {
            [$width, $height] = explode('x', $format);
        }

        return [
            'format' => ['required', 'string', Rule::in(Banner::formatsList())],
            'file' => 'required|image|mimes:jpg,jpeg,png|dimensions:width=' . $width . ',height=' . $height,
        ];
    }
}
