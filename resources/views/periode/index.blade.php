@extends('layouts2.template')
@section('content')
<!-- partial -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <center>
                        <h2>Periode</h2>
                        <h2><small>(Periode pemilihan siswa teladan)</small></h2>
                    </center>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fa fa-clock-o"></i> Data Periode</h4>
                        <a class="btn btn-success my-2" href="/createPeriode" style="width: 125px; margin-left:0px;"><i class="fa fa-plus"></i>
                            Tambah</a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Nama Periode
                                        </th>
                                        <th>
                                            Tanggal Pembuatan
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($periode as $p)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $p->nama_periode }}</td>
                                        <td>{{ date('d F Y H.i', strtotime( $p->created_at )) }}</td>
                                        <td>{{ $p->status }}</td>
                                        <td>
                                            <a href="{{ url('periode/hapus/'. $p->id_periode) }}" class="btn btn-danger"
                                                onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')"><i
                                                    class="fa fa-trash"></i></a>
                                            <a href="{{ url('periode/update/'. $p->id_periode) }}"
                                                class="btn btn-warning"><i class="fa fa-edit"></i></a>
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