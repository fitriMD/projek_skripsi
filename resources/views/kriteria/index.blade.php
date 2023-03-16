@extends('layouts.template')
@section('content')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data User</h4>
                        {{-- <a class="btn btn-success my-2" href="/createKriteria" style="width: 150px; margin-left:10px;"> Tambah Kriteria</a> --}}
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
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
                                    @foreach ($kriteria as $k)
                                    <tr>
                                        <td>{{ $k->nm_kriteria }}</td>
                                        <td>{{ $k->variabel }}</td>
                                        <td>{{ $k->tipe }}</td>
                                        <td>

                                            <a href="{{ url('kriteria/hapus/'. $k->id_kriteria) }}" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')"><i
                                                class="fa fa-trash"></i> Hapus</a>
                                            <a href="{{ url('kriteria/update/'. $k->id_kriteria) }}" class="btn btn-warning"><i
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