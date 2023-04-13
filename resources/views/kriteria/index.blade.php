@extends('layouts2.template')
@section('content')
<!-- partial -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <center>
                        <h2>Data Kriteria</h2>
                        <h2><small>(Kriteria yang digunakan dalam pemilihan siswa teladan)</small></h2>
                    </center>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fa fa-tasks"></i> Data kriteria</h4>
                        {{-- <a class="btn btn-success my-2" href="/createKriteria" style="width: 150px; margin-left:10px;"> Tambah Kriteria</a> --}}
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Nama Kriteria
                                        </th>
                                        <th>
                                            Variabel
                                        </th>
                                        <th>
                                            Tipe
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($kriteria as $k)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $k->nm_kriteria }}</td>
                                        <td>{{ $k->variabel }}</td>
                                        <td>{{ $k->tipe }}</td>
                                        <td>

                                            {{-- <a href="{{ url('kriteria/hapus/'. $k->id_kriteria) }}" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')"><i
                                                class="fa fa-trash"></i> Hapus</a> --}}
                                            <a href="{{ url('kriteria/update/'. $k->id_kriteria) }}" class="btn btn-warning"><i
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