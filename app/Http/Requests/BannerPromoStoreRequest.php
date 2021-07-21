<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerPromoStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'image' => 'required|mimes:jpeg,png,jpg,svg|max:2048',
            'url' => 'nullable|string|max:255',
            'status' => 'in:on|nullable',
            
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'Gambar produk tidak boleh kosong!',
            'image.mimes' => 'Gambar produk hanya boleh jpeg, jpg, png!',
            'image.max' => 'Ukuran gambar produk maksimal 2mb!',
            'url.max' => 'Url maksimal 255 karakter!',
            'status.in' => 'Pilihan status hanya aktif atau tidak aktif!'

            
        ];
    }
}
