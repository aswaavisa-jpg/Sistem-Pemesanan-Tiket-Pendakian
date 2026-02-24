<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentVerificationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'metode_pembayaran' => 'required|in:transfer,cash,e-wallet',
            'bukti_pembayaran' => 'required_if:metode_pembayaran,transfer,e-wallet|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'catatan_pembayaran' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'metode_pembayaran.required' => 'Metode pembayaran harus dipilih',
            'metode_pembayaran.in' => 'Metode pembayaran tidak valid',
            'bukti_pembayaran.required_if' => 'Bukti pembayaran harus diunggah untuk metode transfer/e-wallet',
            'bukti_pembayaran.image' => 'File bukti pembayaran harus berupa gambar',
            'bukti_pembayaran.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'bukti_pembayaran.max' => 'Ukuran gambar maksimal 2MB',
            'catatan_pembayaran.max' => 'Catatan pembayaran maksimal 255 karakter',
        ];
    }
}
