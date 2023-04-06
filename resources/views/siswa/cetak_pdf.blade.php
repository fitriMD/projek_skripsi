<!DOCTYPE html>
<html>
<head>
  <title>
    Daftar Siswa | Peserta Siswa Teladan MI As-Salam
  </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <center>
        <h3>Daftar Siswa Calon Teladan</h3>
        <h4>MI As-salam Watestanjung</h4>
    </center>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIS</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswa as $sw)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$sw->nama}}</td>
                <td>{{$sw->nis}}</td>
                <td>{{$sw->nama_kelas}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>