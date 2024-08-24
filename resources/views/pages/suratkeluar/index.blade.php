@extends('layout.main')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Master /</span> Surat Keluar
    </h4>

    @if (auth()->user()->id_jabatan == 1)
        <!-- Add New Record Button -->
        <div class="mb-3">
            <button class="btn btn-primary" id="add-new-data">
                Add New Surat Keluar
            </button>
        </div>
    @endif

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
                        @if (auth()->user()->id_jabatan == 1)
                            <th style="width: 200px;">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($suratkeluars as $suratkeluar)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $suratkeluar->id_surat_keluar }}</td>
                            <td>{{ $suratkeluar->nomor_surat_keluar }}</td>
                            <td>{{ $suratkeluar->judul_surat_keluar }}</td>
                            <td>{{ $suratkeluar->lampiran }}</td>
                            <td>{{ $suratkeluar->tanggal_surat_keluar }}</td>
                            @if (auth()->user()->id_jabatan == 1)
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm btn-edit"
                                        data-id="{{ $suratkeluar->id_surat_keluar }}"
                                        data-nomor-surat-keluar="{{ $suratkeluar->nomor_surat_keluar }}">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                    <form action="{{ route('suratkeluar.destroy', $suratkeluar->id_surat_keluar) }}"
                                        method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm btn-delete"
                                            data-id="{{ $suratkeluar->id_surat_keluar }}">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="suratkeluar-modal" tabindex="-1" aria-labelledby="suratkeluar-modal-label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="suratkeluar-modal-label">Add/Edit Surat Keluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="suratkeluar-form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="id_surat_keluar" name="id_surat_keluar">
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
                            <label for="id_jenis_surat" class="form-label">Jenis Surat</label>
                            <select id="id_jenis_surat" name="id_jenis_surat"
                                class="form-control @error('id_jenis_surat') is-invalid @enderror" required>
                                <option value="">Select Jenis Surat</option>
                                @foreach ($jenisSurats as $jenisSurat)
                                    <option value="{{ $jenisSurat->id_jenis_surat }}">{{ $jenisSurat->nama_jenis_surat }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_jenis_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nomor_surat_keluar" class="form-label">Nomor Surat Keluar</label>
                            <input type="text" id="nomor_surat_keluar" name="nomor_surat_keluar"
                                class="form-control @error('nomor_surat_keluar') is-invalid @enderror" required>
                            @error('nomor_surat_keluar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="judul_surat_keluar" class="form-label">Judul Surat Keluar</label>
                            <input type="text" id="judul_surat_keluar" name="judul_surat_keluar"
                                class="form-control @error('judul_surat_keluar') is-invalid @enderror" required>
                            @error('judul_surat_keluar')
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
                            <div id="file_surat_view" class="mt-2"></div>
                            <!-- Display the file view button or message -->
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
            var table = $('#table').DataTable({
                drawCallback: function(settings) {
                    $('.btn-edit').click(function() {
                        var id = $(this).data('id');

                        $.ajax({
                            url: '{{ url('suratkeluar') }}/' + id,
                            method: 'GET',
                            success: function(response) {
                                $('#suratkeluar-modal-label').text(
                                    'Edit Surat Keluar');
                                $('#suratkeluar-form').attr('action',
                                    '{{ url('suratkeluar') }}/' +
                                    id);
                                $('#id_surat_keluar').val(id);
                                $('#id_relasi').val(response.id_relasi);
                                $('#id_bagian').val(response.id_bagian);
                                $('#id_jenis_surat').val(response.id_jenis_surat);
                                $('#id_ruang_penyimpanan').val(response
                                    .id_ruang_penyimpanan);
                                $('#nomor_surat_keluar').val(response
                                    .nomor_surat_keluar);
                                $('#judul_surat_keluar').val(response
                                    .judul_surat_keluar);
                                $('#lampiran').val(response.lampiran);
                                $('#perihal').val(response.perihal);
                                $('#keterangan').val(response.keterangan);
                                // Check if the file_surat exists and display it
                                if (response.file_surat) {
                                    var filePath = response.file_surat;
                                    if (!filePath.startsWith(
                                            'storage/suratkeluar/')) {
                                        filePath = 'storage/suratkeluar/' +
                                            filePath;
                                    }
                                    $('#file_surat_view').html(
                                        '<a href="{{ url('') }}/' +
                                        filePath +
                                        '" class="btn btn-info btn-sm" target="_blank">' +
                                        '<i class="fas fa-file-pdf"></i> View Current File</a>'
                                    );
                                } else {
                                    $('#file_surat_view').html(
                                        '<span class="text-muted">No file uploaded.</span>'
                                    );
                                }
                                $('#suratkeluar-modal').modal(
                                    'show'); // Open the modal
                            }
                        });
                    });
                }
            });
            // Handle Add New Surat Keluar button click
            $('#add-new-data').click(function() {
                $('#suratkeluar-modal-label').text('Add New Surat Keluar');
                $('#suratkeluar-form').attr('action', '{{ route('suratkeluar.store') }}');
                $('#id_surat_keluar').val('');
                $('#id_relasi').val('');
                $('#id_bagian').val('');
                $('#id_jenis_surat').val('');
                $('#id_ruang_penyimpanan').val('');
                $('#nomor_surat_keluar').val('');
                $('#judul_surat_keluar').val('');
                $('#lampiran').val('');
                $('#perihal').val('');
                $('#keterangan').val('');
                $('#file_surat').val('');
                $('#suratkeluar-modal').modal('show'); // Open the modal
            });

            // Handle form submit for both add and edit
            $('#suratkeluar-form').submit(function(e) {
                e.preventDefault();
                console.log('Form is being submitted'); // Debug point 1
                var url = $(this).attr('action');
                var method = ($('#id_surat_keluar').val() === '') ? 'POST' : 'PUT';
                var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


                var formData = new FormData(this);
                var formDataObject = Array.from(formData.entries()).reduce((acc, [key, value]) => {
                    // Menangani file dengan cara khusus
                    if (value instanceof File) {
                        acc[key] = value; // Menyimpan objek File
                    } else {
                        acc[key] = value; // Menyimpan nilai string atau lainnya
                    }
                    return acc;
                }, {});

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    method: method,
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log('Response:', response);
                        console.log(response);
                        if ($('#file_surat').val()) {
                            uploadFile(response
                                .id_surat_keluar
                            ); // Misalnya, response mengembalikan ID surat keluar
                        } else {
                            $('#suratkeluar-modal').modal('hide');
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonColor: '#696cff'
                            }).then(() => {
                                window.location
                                    .reload(); // Reload halaman untuk memperbarui tampilan
                            });
                        }
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

            function uploadFile(idSuratKeluar) {
                var formData = new FormData();

                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                formData.append('id_surat_keluar', idSuratKeluar);

                formData.append('file_surat', $('#file_surat')[0].files[0]);

                console.log(formData);

                $.ajax({
                    url: '{{ route('suratkeluar.uploadfile', '') }}' + '/' + idSuratKeluar,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('File uploaded successfully:', response);
                        $('#suratkeluar-modal').modal('hide');
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonColor: '#696cff'
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function(error) {
                        console.error('File upload failed:', error);
                        // Handle error
                    }
                });
            }
        });
    </script>
@endpush
