@extends('layouts2.template')
@section('content')
<!-- partial -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <center>
                        <h2>Data Kelas</h2>
                    </center>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fa fa-institution"></i> Data Kelas</h4>
                        <a class="btn btn-success my-2" href="/createKelas" style="width: 125px; margin-left:0px;"><i class="fa fa-plus"></i>
                            Tambah</a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
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
                                    <?php $no = 1; ?>
                                    @foreach ($kelas as $kls)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $kls->nama_kelas }}</td>
                                        <td>{{ $kls->nama }}</td>
                                        <td>
                                            <a href="{{ url('kelas/hapus/'. $kls->id_kelas) }}" class="btn btn-danger"
                                                onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')"><i
                                                    class="fa fa-trash"></i> Hapus</a>
                                            <a href="{{ url('kelas/update/'. $kls->id_kelas) }}"
                                                class="btn btn-warning"><i class="fa fa-edit"></i> Update</a>
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