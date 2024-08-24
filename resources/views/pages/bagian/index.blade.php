@extends('layout.main')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Master /</span> Bagian
    </h4>


    <!-- Add New Record Button -->
    <div class="mb-3">
        <button class="btn btn-primary" id="add-new-data">
            Add New Bagian
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
                        <th>Bagian</th>
                        @if (auth()->user()->id_jabatan == 1)
                            <th style="width: 200px;">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($bagians as $bagian)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $bagian->id_bagian }}</td>
                            <td>{{ $bagian->nama_bagian }}</td>
                            @if (auth()->user()->id_jabatan == 1)
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm btn-edit"
                                        data-id="{{ $bagian->id_bagian }}" data-nama-bagian="{{ $bagian->nama_bagian }}">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                    <form action="{{ route('bagian.destroy', $bagian->id_bagian) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm btn-delete"
                                            data-id="{{ $bagian->id_bagian }}">
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
    <div class="modal fade" id="bagian-modal" tabindex="-1" aria-labelledby="bagian-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bagian-modal-label">Add/Edit Bagian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="bagian-form">
                        @csrf
                        <input type="hidden" id="id_bagian" name="id_bagian">
                        <div class="mb-3">
                            <label for="nama_bagian" class="form-label">Nama Bagian</label>
                            <input type="text" id="nama_bagian" name="nama_bagian"
                                class="form-control @error('nama_bagian') is-invalid @enderror" required>
                            @error('nama_bagian')
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
                    // Inisialisasi ulang tombol edit setelah DataTable di-render ulang
                    $('.btn-edit').click(function() {
                        var id = $(this).data('id');

                        $.ajax({
                            url: '{{ url('bagian') }}/' + id,
                            method: 'GET',
                            success: function(response) {
                                $('#bagian-modal-label').text('Edit Bagian');
                                $('#bagian-form').attr('action',
                                    '{{ url('bagian') }}/' + id);
                                $('#id_bagian').val(id);
                                $('#nama_bagian').val(response.nama_bagian);
                                $('#bagian-modal').modal('show'); // Open the modal
                            }
                        });
                    });
                }
            });
            // Handle Add New Bagian button click
            $('#add-new-data').click(function() {
                $('#bagian-modal-label').text('Add New Bagian');
                $('#bagian-form').attr('action', '{{ route('bagian.store') }}');
                $('#id_bagian').val('');
                $('#nama_bagian').val('');
                $('#bagian-modal').modal('show'); // Open the modal
            });

            // Handle form submit for both add and edit
            $('#bagian-form').submit(function(e) {
                e.preventDefault();
                var url = $(this).attr('action');
                var method = ($('#id_bagian').val() === '') ? 'POST' : 'PUT';

                $.ajax({
                    url: url,
                    method: method,
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#bagian-modal').modal('hide');
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
