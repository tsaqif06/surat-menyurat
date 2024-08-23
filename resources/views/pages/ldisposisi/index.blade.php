@extends('layout.main')

@section('content')
    <x-breadcrumb :values="[__('menu.agenda.menu'), __('menu.agenda.incoming_letter')]">
    </x-breadcrumb>

    <div class="card mb-5">
        <div class="card-header">
            <form action="{{ url()->current() }}">
                <div class="row">
                    <div class="col">
                        <x-input-form name="since" :label="__('menu.agenda.start_date')" type="date" :value="$since ? date('Y-m-d', strtotime($since)) : ''" />
                    </div>
                    <div class="col">
                        <x-input-form name="until" :label="__('menu.agenda.end_date')" type="date" :value="$until ? date('Y-m-d', strtotime($until)) : ''" />
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">{{ __('menu.general.action') }}</label>
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-primary" type="submit">{{ __('menu.general.filter') }}</button>
                                    <a href="{{ route('ldisposisi.print') . '?' . $query }}" target="_blank"
                                        class="btn btn-primary">
                                        {{ __('menu.general.print') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-responsive text-nowrap">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th style="width: 50px;">Id</th>
                        <th style="width: 100px">Nomor</th>
                        <th>Judul</th>
                        <th>Lampiran</th>
                        <th>Tanggal Disposisi</th>
                    </tr>
                </thead>
                @if ($disposisis)
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($disposisis as $disposisi)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $disposisi->suratMasuk->id_surat_masuk }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ $disposisi->suratMasuk->nomor_surat_masuk }}</strong>
                                </td>
                                <td>{{ $disposisi->suratMasuk->judul_surat_masuk }}</td>
                                <td>{{ $disposisi->suratMasuk->lampiran }}</td>
                                <td>{{ $disposisi->suratMasuk->tanggal_disposisi }}</td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center">
                                {{ __('menu.general.empty') }}
                            </td>
                        </tr>
                    </tbody>
                @endif
                <tfoot class="table-border-bottom-0">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th style="width: 50px;">Id</th>
                        <th style="width: 100px">Nomor</th>
                        <th>Judul</th>
                        <th>Lampiran</th>
                        <th>Tanggal Disposisi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{--  {!! $data->appends(['search' => $search, 'since' => $since, 'until' => $until, 'filter' => $filter])->links() !!}  --}}
@endsection
