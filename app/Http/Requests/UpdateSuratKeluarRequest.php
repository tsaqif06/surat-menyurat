<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSuratKeluarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'id_relasi' => 'required|exists:relasis,id_relasi',
            // 'id_bagian' => 'required|exists:bagians,id_bagian',
            // 'id_ruang_penyimpanan' => 'required|exists:ruang_penyimpanans,id_ruang_penyimpanan',
            // 'id_jenis_surat_masuk' => 'required|exists:jenis_surats,id_jenis_surat', 
            // 'nomor_surat_masuk' => 'required|string|max:50',
            // 'judul_surat_masuk' => 'required|string|max:50',
            // 'lampiran' => 'required|string|max:10',
            // 'perihal' => 'required|string|max:100',
            // 'keterangan' => 'required|string',
            // 'file_surat' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ];
    }
}
