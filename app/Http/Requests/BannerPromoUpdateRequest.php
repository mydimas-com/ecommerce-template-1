<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerPromoUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'image' => 'nullable|mimes:jpeg,png,jpg,svg|max:2048',
            'url' => 'nullable|string|max:255',
            'status' => 'nullable|in:on',
            
        ];
    }

    public function messages()
    {
        return [
            'image.mimes' => 'Gambar produk hanya boleh jpeg, jpg, png!',
            'image.max' => 'Ukuran gambar produk maksimal 2mb!',
            'url.max' => 'Url maksimal 255 karakter!',
            'status.in' => 'Pilihan status hanya aktif atau tidak aktif!'
        ];
    }
}
