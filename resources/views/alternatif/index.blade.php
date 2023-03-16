@extends('layouts.template')
@section('content')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Alternatif</h4>
                        <a class="btn btn-success my-2" href="/createAlternatif" style="width: 150px; margin-left:10px;"> Tambah Data</a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
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
                                    @foreach ($alternatif as $alt)
                                    <tr>
                                        <td>{{ $alt->id_siswa }}</td>
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