@extends('layout.main')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Master /</span> Ruang Penyimpanan
    </h4>

    <!-- Add New Record Button -->
    <div class="mb-3">
        <button class="btn btn-primary" id="add-new-data">
            Add New Ruang Penyimpanan
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
                        <th>Ruang Penyimpanan</th>
                        @if (auth()->user()->id_jabatan == 1)
                            <th style="width: 200px;">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($ruangpenyimpanans as $ruangpenyimpanan)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $ruangpenyimpanan->id_ruang_penyimpanan }}</td>
                            <td>{{ $ruangpenyimpanan->nama_ruang }}</td>
                            @if (auth()->user()->id_jabatan == 1)
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm btn-edit"
                                        data-id="{{ $ruangpenyimpanan->id_ruang_penyimpanan }}"
                                        data-nama-ruangpenyimpanan="{{ $ruangpenyimpanan->nama_ruang }}">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                    <form action="{{ route('ruang.destroy', $ruangpenyimpanan->id_ruang_penyimpanan) }}"
                                        method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm btn-delete"
                                            data-id="{{ $ruangpenyimpanan->id_ruang_penyimpanan }}">
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
    <div class="modal fade" id="ruangpenyimpanan-modal" tabindex="-1" aria-labelledby="ruangpenyimpanan-modal-label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ruangpenyimpanan-modal-label">Add/Edit Ruang Penyimpanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="ruangpenyimpanan-form">
                        @csrf
                        <input type="hidden" id="id_ruang_penyimpanan" name="id_ruang_penyimpanan">
                        <div class="mb-3">
                            <label for="nama_ruang" class="form-label">Nama Ruang Penyimpanan</label>
                            <input type="text" id="nama_ruang" name="nama_ruang"
                                class="form-control @error('nama_ruang') is-invalid @enderror" required>
                            @error('nama_ruang')
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
            // Handle Add New ruangpenyimpanan button click
            $('#add-new-data').click(function() {
                $('#ruangpenyimpanan-modal-label').text('Add New Ruang Penyimpanan');
                $('#ruangpenyimpanan-form').attr('action', '{{ route('ruang.store') }}');
                $('#id_ruang_penyimpanan').val('');
                $('#nama_ruang').val('');
                $('#ruangpenyimpanan-modal').modal('show'); // Open the modal
            });

            // Handle Edit button click
            $('.btn-edit').click(function() {
                var id = $(this).data('id');

                $.ajax({
                    url: '{{ url('ruang') }}/' + id,
                    method: 'GET',
                    success: function(response) {
                        $('#ruangpenyimpanan-modal-label').text('Edit Ruang Penyimpanan');
                        $('#ruangpenyimpanan-form').attr('action', '{{ url('ruang') }}/' +
                            id);
                        $('#id_ruang_penyimpanan').val(id);
                        $('#nama_ruang').val(response.nama_ruang);
                        $('#ruangpenyimpanan-modal').modal('show'); // Open the modal
                    }
                });
            });

            // Handle form submit for both add and edit
            $('#ruangpenyimpanan-form').submit(function(e) {
                e.preventDefault();
                var url = $(this).attr('action');
                var method = ($('#id_ruang_penyimpanan').val() === '') ? 'POST' : 'PUT';

                $.ajax({
                    url: url,
                    method: method,
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#ruangpenyimpanan-modal').modal('hide');
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
                    }
                });
            });
        });
    </script>
@endpush
