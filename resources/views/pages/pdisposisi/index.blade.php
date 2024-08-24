@extends('layout.main')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Persetujuan /</span> Disposisi Surat Masuk
    </h4>

    <!-- Add New Record Button -->
    {{--  <div class="mb-3">
        <button class="btn btn-primary" id="add-new-data">
            Add New suratmasuk
        </button>
    </div>  --}}

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table id="table" class="datatables-basic table table-bordered border-top">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th style="width: 50px;">Id</th>
                        <th style="width: 100px;">Nomor</th>
                        <th>Judul</th>
                        <th>Tanggal Disposisi</th>
                        <th style="width: 50px">Status</th>
                        @if (auth()->user()->id_jabatan == 2)
                            <th style="width: 200px;">Action</th>
                        @endif
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
                            <td>{{ $suratmasuk->tanggal_disposisi }}</td>
                            <td>
                                @if ($suratmasuk->status_surat == 0)
                                    <span class="badge bg-danger">Ditolak</span>
                                @elseif ($suratmasuk->status_surat == 1)
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif ($suratmasuk->status_surat == 2)
                                    <span class="badge bg-success">Disetujui</span>
                                @endif
                            </td>
                            @if (auth()->user()->id_jabatan == 2)
                                <td>
                                    @if ($suratmasuk->status_surat == 1)
                                        <button type="button" class="btn btn-success btn-sm btn-setuju"
                                            data-id="{{ $suratmasuk->id_surat_masuk }}">
                                            <i class="bx bx-check"></i> Setuju
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm btn-tolak"
                                            data-id="{{ $suratmasuk->id_surat_masuk }}">
                                            <i class="bx bx-x"></i> Tidak Setuju
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-secondary btn-sm" disabled>
                                            <i class="bx bx-lock"></i> Tidak Ada Tindakan
                                        </button>
                                    @endif
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
    <div class="modal fade" id="suratmasuk-modal" tabindex="-1" aria-labelledby="suratmasuk-modal-label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="suratmasuk-modal-label">Add/Edit suratmasuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="suratmasuk-form">
                        @csrf
                        <input type="hidden" id="id_surat_masuk" name="id_surat_masuk">
                        <div class="mb-3">
                            <label for="nama_suratmasuk" class="form-label">Nama suratmasuk</label>
                            <input type="text" id="nama_suratmasuk" name="nama_suratmasuk"
                                class="form-control @error('nama_suratmasuk') is-invalid @enderror" required>
                            @error('nama_suratmasuk')
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
                    // Handle Edit button click
                    $(document).on('click', '.btn-setuju', function() {
                        var id = $(this).data('id');

                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Anda akan menyetujui disposisi surat masuk ini.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#28a745',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Setujui!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '{{ url('pdisposisi/setuju') }}/' + id,
                                    method: 'POST',
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        status: 2
                                    },
                                    success: function(response) {
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            text: 'Surat telah disetujui.',
                                            icon: 'success',
                                            confirmButtonColor: '#28a745'
                                        }).then(() => {
                                            location.reload();
                                        });
                                    }
                                });
                            }
                        });
                    });

                    // Handle Tolak button click
                    $(document).on('click', '.btn-tolak', function() {
                        var id = $(this).data('id');

                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Anda akan menolak disposisi surat masuk ini.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#ffc107',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Tolak!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '{{ url('pdisposisi/tolak') }}/' + id,
                                    method: 'POST',
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        status: 0
                                    },
                                    success: function(response) {
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            text: 'Surat telah ditolak.',
                                            icon: 'success',
                                            confirmButtonColor: '#ffc107'
                                        }).then(() => {
                                            location.reload();
                                        });
                                    }
                                });
                            }
                        });
                    });
                }
            });
            // Handle Add New suratmasuk button click
            $('#add-new-data').click(function() {
                $('#suratmasuk-modal-label').text('Add New suratmasuk');
                {{--  $('#suratmasuk-form').attr('action', '{{ route('suratmasuk.store') }}');  --}}
                $('#id_suratmasuk').val('');
                $('#nama_suratmasuk').val('');
                $('#suratmasuk-modal').modal('show'); // Open the modal
            });
        });
    </script>
@endpush
