@extends('layouts2.template')
@section('content')
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
                        <form method="post" action={{ url('/createkelas') }} class="form-horizontal">
                            @csrf
                            <h4 class="card-title">Tambah Data Kelas</h4>
                            <form class="forms-sample">
                                <div class="form-group">
                                    <label for="exampleInputName1">Nama Kelas</label>
                                    <input type="text" name="nama_kelas" class="form-control" id="exampleInputName1"
                                        placeholder="Kelas">
                                </div>
                                <div class="form-group">
                                    <label for="wali_kelas">Wali Kelas</label>
                                    <select class="form-control" name="id_user_walikelas" id="id_user_walikelas">
                                        <option selected disabled>Pilih Wali Kelas</option>
                                        @foreach($waliKelas as $waliKelas)
                                        <option value="{{$waliKelas->id_user}}">{{ $waliKelas->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="{{ url('/daftarKelas')}}" class="btn btn-light">Cancel</a>
                            </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection