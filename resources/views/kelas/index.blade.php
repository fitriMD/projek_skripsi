@extends('layouts.template')
@section('content')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Kelas</h4>
                        <a class="btn btn-success my-2" href="/createKelas" style="width: 150px; margin-left:10px;">
                            Tambah Kelas</a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            Nama Kelas
                                        </th>
                                        <th>
                                            Wali Kelas
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kelas as $kls)
                                    <tr>
                                        <td>{{ $kls->nama_kelas }}</td>
                                        <td>{{ $kls->nama }}</td>
                                        <td>
                                            <a href="{{ url('kelas/hapus/'. $kls->id_kelas) }}" class="btn btn-danger"
                                                onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')"><i
                                                    class="fa fa-trash"></i> Hapus</a>
                                            <a href="{{ url('kelas/update/'. $kls->id_kelas) }}"
                                                class="btn btn-warning"><i class="fa fa-trash"></i> Update</a>
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