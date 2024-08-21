@extends('layout.main')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Persetujuan /</span> Surat Keluar
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
                        <th>Tanggal Kirim</th>
                        <th style="width: 50px">Status</th>
                        <th style="width: 200px;">Action</th>
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
                            <td>{{ $suratkeluar->tanggal_surat_keluar }}</td>
                            <td>
                                @if ($suratkeluar->status_surat == 0)
                                    <span class="badge bg-danger">Ditolak</span>
                                @elseif ($suratkeluar->status_surat == 1)
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif ($suratkeluar->status_surat == 2)
                                    <span class="badge bg-success">Disetujui</span>
                                @endif
                            </td>
                            <td>
                                @if ($suratkeluar->status_surat == 1)
                                    <button type="button" class="btn btn-success btn-sm btn-setuju"
                                        data-id="{{ $suratkeluar->id_surat_keluar }}">
                                        <i class="bx bx-check"></i> Setuju
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm btn-tolak"
                                        data-id="{{ $suratkeluar->id_surat_keluar }}">
                                        <i class="bx bx-x"></i> Tidak Setuju
                                    </button>
                                @else
                                    <button type="button" class="btn btn-secondary btn-sm" disabled>
                                        <i class="bx bx-lock"></i> Tidak Ada Tindakan
                                    </button>
                                @endif
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
    <div class="modal fade" id="suratkeluar-modal" tabindex="-1" aria-labelledby="suratkeluar-modal-label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="suratkeluar-modal-label">Add/Edit suratkeluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="suratkeluar-form">
                        @csrf
                        <input type="hidden" id="id_surat_keluar" name="id_surat_keluar">
                        <div class="mb-3">
                            <label for="nama_suratkeluar" class="form-label">Nama suratkeluar</label>
                            <input type="text" id="nama_suratkeluar" name="nama_suratkeluar"
                                class="form-control @error('nama_suratkeluar') is-invalid @enderror" required>
                            @error('nama_suratkeluar')
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
            // Handle Add New suratkeluar button click
            $('#add-new-data').click(function() {
                $('#suratkeluar-modal-label').text('Add New suratkeluar');
                {{--  $('#suratkeluar-form').attr('action', '{{ route('suratkeluar.store') }}');  --}}
                $('#id_suratkeluar').val('');
                $('#nama_suratkeluar').val('');
                $('#suratkeluar-modal').modal('show'); // Open the modal
            });

            // Handle Edit button click
            $(document).on('click', '.btn-setuju', function() {
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda akan menyetujui surat keluar ini.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Setujui!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ url('approve/setuju') }}/' + id,
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
                    text: "Anda akan menolak surat keluar ini.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ffc107',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Tolak!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ url('approve/tolak') }}/' + id,
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
        });
    </script>
@endpush
