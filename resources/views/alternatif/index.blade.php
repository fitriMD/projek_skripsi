@extends('layouts2.template')
@section('content')
<!-- partial -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <center>
                        <h2>Data Alternatif</h2>
                        <h2><small>(Nilai kandidat siswa teladan sesuai kriteria)</small></h2>
                    </center>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fa fa-file"></i> Alternatif</h4>
                        <a class="btn btn-success my-2" href="/createAlternatif" style="width: 125px; margin-left:0px;"><i class="fa fa-plus"></i> Tambah</a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Nama Siswa
                                        </th>
                                        <th>
                                            C1
                                        </th>
                                        <th>
                                            C2
                                        </th>
                                        <th>
                                            C3
                                        </th>
                                        <th>
                                            C4
                                        </th>
                                        <th>
                                            C5
                                        </th>
                                        <th>
                                            C6
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($alternatif as $alt)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $alt->nama }}</td>
                                        <td>{{ $alt->C1 }}</td>
                                        <td>{{ $alt->C2 }}</td>
                                        <td>{{ $alt->C3 }}</td>
                                        <td>{{ $alt->C4 }}</td>
                                        <td>{{ $alt->C5 }}</td>
                                        <td>{{ $alt->C6 }}</td>
                                        <td>

                                            <a href="{{ url('alternatif/hapus/'. $alt->id_alternatif) }}" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')"><i
                                                class="fa fa-trash"></i> Hapus</a>
                                            <a href="{{ url('alternatif/update/'. $alt->id_alternatif) }}" class="btn btn-warning"><i
                                                    class="fa fa-edit"></i> Update</a>    
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