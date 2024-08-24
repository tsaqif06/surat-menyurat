@extends('layout.main')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Master /</span> Master
    </h4>

    <!-- Add New Record Button -->
    <div class="mb-3">
        <button class="btn btn-primary" id="add-new-data">
            Add New Jabatan
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
                        <th>Jabatan</th>
                        @if (auth()->user()->id_jabatan == 1)
                            <th style="width: 200px;">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($jabatans as $jabatan)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $jabatan->id_jabatan }}</td>
                            <td>{{ $jabatan->nama_jabatan }}</td>
                            @if (auth()->user()->id_jabatan == 1)
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm btn-edit"
                                        data-id="{{ $jabatan->id_jabatan }}"
                                        data-nama-jabatan="{{ $jabatan->nama_jabatan }}">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                    <form action="{{ route('jabatan.destroy', $jabatan->id_jabatan) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm btn-delete"
                                            data-id="{{ $jabatan->id_jabatan }}">
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

    <!-- Modal Structure -->
    <div class="modal fade" id="jabatan-modal" tabindex="-1" aria-labelledby="jabatan-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jabatan-modal-label">Add/Edit Jabatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="jabatan-form">
                        @csrf
                        <input type="hidden" id="id_jabatan" name="id_jabatan">
                        <div class="mb-3">
                            <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                            <input type="text" id="nama_jabatan" name="nama_jabatan"
                                class="form-control @error('nama_jabatan') is-invalid @enderror" required>
                            @error('nama_jabatan')
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
                            url: '{{ url('jabatan') }}/' + id,
                            method: 'GET',
                            success: function(response) {
                                $('#jabatan-modal-label').text('Edit Jabatan');
                                $('#jabatan-form').attr('action',
                                    '{{ url('jabatan') }}/' + id);
                                $('#id_jabatan').val(id);
                                $('#nama_jabatan').val(response.nama_jabatan);
                                $('#jabatan-modal').modal('show'); // Open the modal
                            }
                        });
                    });
                }
            });

            // Handle Add New Jabatan button click
            $('#add-new-data').click(function() {
                $('#jabatan-modal-label').text('Add New Jabatan');
                $('#jabatan-form').attr('action', '{{ route('jabatan.store') }}');
                $('#id_jabatan').val('');
                $('#nama_jabatan').val('');
                $('#jabatan-modal').modal('show'); // Open the modal
            });

            // Handle form submit for both add and edit
            $('#jabatan-form').submit(function(e) {
                e.preventDefault();
                var url = $(this).attr('action');
                var method = ($('#id_jabatan').val() === '') ? 'POST' : 'PUT';

                $.ajax({
                    url: url,
                    method: method,
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#jabatan-modal').modal('hide');
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
