@extends('layout.main')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">DataTables /</span> Basic
    </h4>

    <!-- Add New Record Button -->
    <div class="mb-3">
        <button class="btn btn-primary" id="add-new-data">
            Add New Surat Masuk
        </button>
    </div>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table id="table" class="datatables-basic table table-bordered border-top">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th style="width: 50px;">Id</th>
                        <th>Nomor</th>
                        <th>Judul</th>
                        <th>Lampiran</th>
                        <th>Tgl Surat Masuk</th>
                        <th style="width: 200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($suratmasuks as $suratmasuk)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $suratmasuk->id_surat_masuk }}</td>
                            <td>{{ $suratmasuk->nomor_surat_masuk }}</td>
                            <td>{{ $suratmasuk->judul_surat_masuk }}</td>
                            <td>{{ $suratmasuk->lampiran }}</td>
                            <td>{{ $suratmasuk->tanggal_surat_masuk }}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm btn-edit"
                                    data-id="{{ $suratmasuk->id_surat_masuk }}"
                                    data-nomor-surat-masuk="{{ $suratmasuk->nomor_surat_masuk }}">
                                    <i class="bx bx-edit"></i>
                                </button>
                                <form action="{{ route('suratmasuk.destroy', $suratmasuk->id_surat_masuk) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm btn-delete"
                                        data-id="{{ $suratmasuk->id_surat_masuk }}">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Structure -->
    <div class="modal fade" id="suratmasuk-modal" tabindex="-1" aria-labelledby="suratmasuk-modal-label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="suratmasuk-modal-label">Add/Edit Surat Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="suratmasuk-form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="id_surat_masuk" name="id_surat_masuk">
                        <div class="mb-3">
                            <label for="id_relasi" class="form-label">Relasi</label>
                            <select id="id_relasi" name="id_relasi"
                                class="form-control @error('id_relasi') is-invalid @enderror" required>
                                <option value="">Select Relasi</option>
                                @foreach ($relasis as $relasi)
                                    <option value="{{ $relasi->id_relasi }}">{{ $relasi->nama_relasi }}</option>
                                @endforeach
                            </select>
                            @error('id_relasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="id_bagian" class="form-label">Bagian</label>
                            <select id="id_bagian" name="id_bagian"
                                class="form-control @error('id_bagian') is-invalid @enderror" required>
                                <option value="">Select Bagian</option>
                                @foreach ($bagians as $bagian)
                                    <option value="{{ $bagian->id_bagian }}">{{ $bagian->nama_bagian }}</option>
                                @endforeach
                            </select>
                            @error('id_bagian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="id_ruang_penyimpanan" class="form-label">Ruang Penyimpanan</label>
                            <select id="id_ruang_penyimpanan" name="id_ruang_penyimpanan"
                                class="form-control @error('id_ruang_penyimpanan') is-invalid @enderror" required>
                                <option value="">Select Ruang Penyimpanan</option>
                                @foreach ($ruangPenyimpanans as $ruangPenyimpanan)
                                    <option value="{{ $ruangPenyimpanan->id_ruang_penyimpanan }}">
                                        {{ $ruangPenyimpanan->nama_ruang }}</option>
                                @endforeach
                            </select>
                            @error('id_ruang_penyimpanan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="id_jenis_surat_masuk" class="form-label">Jenis Surat</label>
                            <select id="id_jenis_surat_masuk" name="id_jenis_surat_masuk"
                                class="form-control @error('id_jenis_surat_masuk') is-invalid @enderror" required>
                                <option value="">Select Jenis Surat</option>
                                @foreach ($jenisSurats as $jenisSurat)
                                    <option value="{{ $jenisSurat->id_jenis_surat }}">{{ $jenisSurat->nama_jenis_surat }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_jenis_surat_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nomor_surat_masuk" class="form-label">Nomor Surat Masuk</label>
                            <input type="text" id="nomor_surat_masuk" name="nomor_surat_masuk"
                                class="form-control @error('nomor_surat_masuk') is-invalid @enderror" required>
                            @error('nomor_surat_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="judul_surat_masuk" class="form-label">Judul Surat Masuk</label>
                            <input type="text" id="judul_surat_masuk" name="judul_surat_masuk"
                                class="form-control @error('judul_surat_masuk') is-invalid @enderror" required>
                            @error('judul_surat_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="lampiran" class="form-label">Lampiran</label>
                            <input type="text" id="lampiran" name="lampiran"
                                class="form-control @error('lampiran') is-invalid @enderror" required>
                            @error('lampiran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="perihal" class="form-label">Perihal</label>
                            <input type="text" id="perihal" name="perihal"
                                class="form-control @error('perihal') is-invalid @enderror" required>
                            @error('perihal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" id="keterangan" name="keterangan"
                                class="form-control @error('keterangan') is-invalid @enderror" required>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="file_surat" class="form-label">File Surat</label>
                            <input type="file" id="file_surat" name="file_surat"
                                class="form-control @error('file_surat') is-invalid @enderror">
                            @error('file_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            // Handle Add New Surat Masuk button click
            $('#add-new-data').click(function() {
                $('#suratmasuk-modal-label').text('Add New Surat Masuk');
                $('#suratmasuk-form').attr('action', '{{ route('suratmasuk.store') }}');
                $('#id_surat_masuk').val('');
                $('#id_relasi').val('');
                $('#id_bagian').val('');
                $('#id_jenis_surat_masuk').val('');
                $('#id_ruang_penyimpanan').val('');
                $('#nomor_surat_masuk').val('');
                $('#judul_surat_masuk').val('');
                $('#lampiran').val('');
                $('#perihal').val('');
                $('#keterangan').val('');
                $('#file_surat').val('');
                $('#suratmasuk-modal').modal('show'); // Open the modal
            });

            // Handle Edit button click
            $('.btn-edit').click(function() {
                var id = $(this).data('id');

                $.ajax({
                    url: '{{ url('suratmasuk') }}/' + id,
                    method: 'GET',
                    success: function(response) {
                        $('#suratmasuk-modal-label').text('Edit Surat Masuk');
                        $('#suratmasuk-form').attr('action', '{{ url('suratmasuk') }}/' + id);
                        $('#id_surat_masuk').val(id);
                        $('#id_relasi').val(response.id_relasi);
                        $('#id_bagian').val(response.id_bagian);
                        $('#id_jenis_surat_masuk').val(response.id_jenis_surat_masuk);
                        $('#id_ruang_penyimpanan').val(response.id_ruang_penyimpanan);
                        $('#nomor_surat_masuk').val(response.nomor_surat_masuk);
                        $('#judul_surat_masuk').val(response.judul_surat_masuk);
                        $('#lampiran').val(response.lampiran);
                        $('#perihal').val(response.perihal);
                        $('#keterangan').val(response.keterangan);
                        // $('#file_surat').val(response.file_surat);
                        $('#suratmasuk-modal').modal('show'); // Open the modal
                    }
                });
            });



            // Handle form submit for both add and edit
            $('#suratmasuk-form').submit(function(e) {
                e.preventDefault();
                console.log('Form is being submitted'); // Debug point 1
                var url = $(this).attr('action');
                var method = ($('#id_surat_masuk').val() === '') ? 'POST' : 'PUT';
                var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


                var formData = new FormData();
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content'));
                formData.append('id_surat_masuk', document.querySelector('input[name="id_surat_masuk"]')
                    .value);
                formData.append('id_relasi', document.querySelector('select[name="id_relasi"]').value);
                formData.append('id_bagian', document.querySelector('select[name="id_bagian"]').value);
                formData.append('id_ruang_penyimpanan', document.querySelector(
                    'select[name="id_ruang_penyimpanan"]').value);
                formData.append('id_jenis_surat_masuk', document.querySelector(
                    'select[name="id_jenis_surat_masuk"]').value);
                formData.append('nomor_surat_masuk', document.querySelector(
                    'input[name="nomor_surat_masuk"]').value);
                formData.append('judul_surat_masuk', document.querySelector(
                    'input[name="judul_surat_masuk"]').value);
                formData.append('lampiran', document.querySelector('input[name="lampiran"]').value);
                formData.append('perihal', document.querySelector('input[name="perihal"]').value);
                formData.append('keterangan', document.querySelector('input[name="keterangan"]').value);
                formData.append('file_surat', document.querySelector('input[name="file_surat"]').files[0]); // Pastikan file ditambahkan dengan benar

                var formDataObject = Array.from(formData.entries()).reduce((acc, [key, value]) => {
                    // Menangani file dengan cara khusus
                    if (value instanceof File) {
                        acc[key] = value; // Menyimpan objek File
                    } else {
                        acc[key] = value; // Menyimpan nilai string atau lainnya
                    }
                    return acc;
                }, {});

                console.log($(this).serialize());
                console.log(formData)


                for (var pair of formData.entries()) {
                    console.log(pair[0] + ', ' + pair[1]);
                }



                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    method: method,
                    data: $(this).serialize(),
                    // data: formData,
                    processData: false, // Prevent jQuery from automatically processing data
                    // contentType: false, // Prevent jQuery from automatically setting contentType
                    success: function(response) {
                        console.log('Success:', response); // Debug point 4
                        $('#suratmasuk-modal').modal('hide');
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonColor: '#696cff'
                        }).then(() => {
                            // Arahkan kembali ke halaman utama atau reload data
                            window.location
                                .reload(); // Reload halaman untuk memperbarui tampilan
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error); // Debug point 5
                        console.log('Response:', xhr.responseText); // Debug point 6
                        console.log('Status:', status); // Debug point 7
                        console.log('AJAX URL:', url); // Debug point 8

                        // Try to parse the response as JSON
                        try {
                            let response = JSON.parse(xhr.responseText);
                            if (response.errors) {
                                // Display validation errors
                                console.log('Validation Errors:', response.errors);
                                Swal.fire({
                                    title: 'Validation Errors',
                                    text: JSON.stringify(response.errors),
                                    icon: 'error',
                                    confirmButtonColor: '#696cff'
                                });
                            } else {
                                // Display general error
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An unexpected error occurred.',
                                    icon: 'error',
                                    confirmButtonColor: '#696cff'
                                });
                            }
                        } catch (e) {
                            // Handle JSON parse errors
                            console.error('Failed to parse error response:', e);
                        }
                    }

                });
            });
        });
    </script>
@endpush
