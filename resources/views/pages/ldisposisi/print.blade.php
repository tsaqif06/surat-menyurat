<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            margin-bottom: 5px;
        }

        h4 {
            margin-top: 0;
            font-weight: normal;
        }

        table {
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
        }

        #filter-section {
            margin: 30px 0;
            text-align: start;
        }
    </style>
</head>

<body onload="window.print()">

    <h1>Laporan Disposisi Surat Masuk</h1>
    <hr>

    <h2>{{ $title }}</h2>

    @if ($since && $until)
        <div id="filter-section">
             {{ "$since - $until" }}
            <br>
            Total: {{ count($disposisis) }}
        </div>
    @endif

    <table>
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
    </table>

</body>

</html>
