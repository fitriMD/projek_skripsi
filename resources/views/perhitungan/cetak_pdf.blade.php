<!DOCTYPE html>
<html>

<head>
    <title>
        Hasil Perangkingan | Pemilihan Siswa Teladan MI As-Salam
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 10pt;
        }

        .center {
            text-align: center;
        }

        .full {
            width: 100%;
        }

        .wrapper {
            padding-left: 30px;
            padding-right: 30px;
            padding-top: 10px;
        }

        .underline {
            text-decoration: underline;
        }

        .bt-1 {
            border-top: 3px solid black;
        }

        .bb-1 {
            border-bottom: 3px solid black;
        }
        
    </style>
    <div class="center full">
        <h3 class="underline"><strong>Hasil Perangkingan Siswa Teladan</strong> <br>
            MI As-Salam Watestanjung
        </h3>
        <strong>Periode {{$periode->nama_periode}}</strong>

        
    </div>
    <div class="wrapper">
        <div class="bt-1 bb-1">
            <table class='table table-bordered'>
                @php
                $kolom = $topsis->first();
                $json_relatif = json_decode( $kolom->jarak_relatif);
                @endphp
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIS</th>
                        {{-- <th>Kelas</th> --}}
                        <th>Hasil Perhitungan</th>
                        <th>Rangking</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($json_relatif AS $no => $isi)
                    <tr>
                        <td>{{$isi->nama }}</td>
                        <td>{{$isi->nis }}</td>
                        {{-- <td>{{$isi->id_kelas_siswa}}</td> --}}
                        <td>{{number_format($isi->hasilJarak, 2)}}</td>
                        <td>{{$no + 1}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>