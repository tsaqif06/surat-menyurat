@extends('layout.main')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Master /</span> Jenis Surat
    </h4>

    <!-- Add New Record Button -->
    <div class="mb-3">
        <button class="btn btn-primary" id="add-new-data">
            Add New Jenis Surat
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
                        <th>Jenis Surat</th>
                        @if (auth()->user()->id_jabatan == 1)
                            <th style="width: 200px;">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($jenissurats as $jenissurat)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $jenissurat->id_jenis_surat }}</td>
                            <td>{{ $jenissurat->nama_jenis_surat }}</td>
                            @if (auth()->user()->id_jabatan == 1)
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm btn-edit"
                                        data-id="{{ $jenissurat->id_jenis_surat }}"
                                        data-nama-jenissurat="{{ $jenissurat->nama_jenis_surat }}">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                    <form action="{{ route('jenis.destroy', $jenissurat->id_jenis_surat) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm btn-delete"
                                            data-id="{{ $jenissurat->id_jenis_surat }}">
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
    <div class="modal fade" id="jenissurat-modal" tabindex="-1" aria-labelledby="jenissurat-modal-label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jenissurat-modal-label">Add/Edit Jenis Surat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="jenissurat-form">
                        @csrf
                        <input type="hidden" id="id_jenis_surat" name="id_jenis_surat">
                        <div class="mb-3">
                            <label for="nama_jenis_surat" class="form-label">Nama Jenis Surat</label>
                            <input type="text" id="nama_jenis_surat" name="nama_jenis_surat"
                                class="form-control @error('nama_jenis_surat') is-invalid @enderror" required>
                            @error('nama_jenis_surat')
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
                            url: '{{ url('jenis') }}/' + id,
                            method: 'GET',
                            success: function(response) {
                                $('#jenissurat-modal-label').text(
                                    'Edit Jenis Surat');
                                $('#jenissurat-form').attr('action',
                                    '{{ url('jenis') }}/' + id);
                                $('#id_jenis_surat').val(id);
                                $('#nama_jenis_surat').val(response
                                    .nama_jenis_surat);
                                $('#jenissurat-modal').modal(
                                    'show'); // Open the modal
                            }
                        });
                    });
                }
            });

            // Handle Add New Jenis Surat button click
            $('#add-new-data').click(function() {
                $('#jenissurat-modal-label').text('Add New Jenis Surat');
                $('#jenissurat-form').attr('action', '{{ route('jenis.store') }}');
                $('#id_jenis_surat').val('');
                $('#nama_jenis_surat').val('');
                $('#jenissurat-modal').modal('show'); // Open the modal
            });



            // Handle form submit for both add and edit
            $('#jenissurat-form').submit(function(e) {
                e.preventDefault();
                var url = $(this).attr('action');
                var method = ($('#id_jenis_surat').val() === '') ? 'POST' : 'PUT';

                $.ajax({
                    url: url,
                    method: method,
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#jenissurat-modal').modal('hide');
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
