@extends('layouts2.template')
@section('content')
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
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form method="post" action={{ url('/createperiode') }} class="form-horizontal">
                            @csrf
                        <h4 class="card-title">Tambah Data Periode</h4>
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputName1">Periode</label>
                                <input type="text" name="nama_periode" class="form-control" id="exampleInputName1" placeholder="Contoh : Semester Ganjil Tahun Ajaran 2022/2023">
                            </div>
                            <div class="form-group">
                                <label for="role">Status</label>
                                <select class="form-control" name="status" id="role">
                                    <option value="aktif">Aktif</option>
                                    <option value="tidak_aktif">Tidak Aktif</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{ url('/daftarPeriode') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection