@extends('layout.main')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Master /</span> Relasi
    </h4>

    <!-- Add New Record Button -->
    <div class="mb-3">
        <button class="btn btn-primary" id="add-new-data">
            Add New Relasi
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
                        <th>Relasi</th>
                        @if (auth()->user()->id_jabatan == 1)
                            <th style="width: 200px;">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($relasis as $relasi)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $relasi->id_relasi }}</td>
                            <td>{{ $relasi->nama_relasi }}</td>
                            @if (auth()->user()->id_jabatan == 1)
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm btn-edit"
                                        data-id="{{ $relasi->id_relasi }}" data-nama-relasi="{{ $relasi->nama_relasi }}">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                    <form action="{{ route('relasi.destroy', $relasi->id_relasi) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm btn-delete"
                                            data-id="{{ $relasi->id_relasi }}">
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

        <!-- Modal Structure -->
        <div class="modal fade" id="relasi-modal" tabindex="-1" aria-labelledby="relasi-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="relasi-modal-label">Add/Edit Relasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="relasi-form">
                            @csrf
                            <input type="hidden" id="id_relasi" name="id_relasi">
                            <div class="mb-3">
                                <label for="nama_relasi" class="form-label">Nama Relasi</label>
                                <input type="text" id="nama_relasi" name="nama_relasi"
                                    class="form-control @error('nama_relasi') is-invalid @enderror" required>
                                @error('nama_relasi')
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
                                url: '{{ url('relasi') }}/' + id,
                                method: 'GET',
                                success: function(response) {
                                    $('#relasi-modal-label').text('Edit Relasi');
                                    $('#relasi-form').attr('action',
                                        '{{ url('relasi') }}/' + id);
                                    $('#id_relasi').val(id);
                                    $('#nama_relasi').val(response.nama_relasi);
                                    $('#relasi-modal').modal('show'); // Open the modal
                                }
                            });
                        });
                    }
                });
                // Handle Add New Relasi button click
                $('#add-new-data').click(function() {
                    $('#relasi-modal-label').text('Add New Relasi');
                    $('#relasi-form').attr('action', '{{ route('relasi.store') }}');
                    $('#id_relasi').val('');
                    $('#nama_relasi').val('');
                    $('#relasi-modal').modal('show'); // Open the modal
                });

                // Handle form submit for both add and edit
                $('#relasi-form').submit(function(e) {
                    e.preventDefault();
                    var url = $(this).attr('action');
                    var method = ($('#id_relasi').val() === '') ? 'POST' : 'PUT';

                    $.ajax({
                        url: url,
                        method: method,
                        data: $(this).serialize(),
                        success: function(response) {
                            $('#relasi-modal').modal('hide');
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
