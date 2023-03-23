@extends('layouts.template')
@section('content')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Siswa</h4>
                        <a class="btn btn-success my-2" href="/createSiswa" style="width: 150px; margin-left:10px;"> Tambah Siswa</a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            Nama
                                        </th>
                                        <th>
                                            Nomor Induk Siswa
                                        </th>
                                        <th>
                                            Jenis Kelamin
                                        </th>
                                        <th>
                                            Kelas
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswa as $data)
                                    <tr>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->nis }}</td>
                                        <td>{{ $data->gender }}</td>
                                        <td>{{ $data->nama_kelas }}</td>
                                        <td>

                                            <a href="{{ url('siswa/hapus/'. $data->id_siswa) }}" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')"><i
                                                class="fa fa-trash"></i> Hapus</a>
                                            <a href="{{ url('siswa/update/'. $data->id_siswa) }}" class="btn btn-warning"><i
                                                    class="fa fa-trash"></i> Update</a>    
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection