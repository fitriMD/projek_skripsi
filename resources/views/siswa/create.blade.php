@extends('layouts2.template')
@section('content')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <center>
                        <h2>Data Siswa</h2>
                        <h2><small>(Kandidat Siswa Teladan)</small></h2>
                    </center>
                </div>
            </div>
        </div>
        <div class="row column2 graph margin_bottom_30">
            <div class="col-md-l2 col-lg-12">
                <div class="white_shd full">
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
                            <form method="post" action={{ url('/createsiswa') }} class="form-horizontal">
                                @csrf
                                <h4 class="card-title">Tambah Data Siswa</h4>
                                <form class="forms-sample">
                                    <div class="form-group">
                                        <label for="exampleInputCity1">Periode</label>
                                        <select class="form-control" name="id_periode" id="exampleSelectGender">
                                            <option selected disabled>Pilih Periode</option>
                                            @foreach($periode as $p)
                                            <option value="{{$p->id_periode}}" @if ( $p->status == "aktif" ) selected="selected" @endif>{{ $p->nama_periode }}</option>
                                            @endforeach
                                        </select>                            
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Nomor Induk Siswa</label>
                                        <input type="text" name="nis" class="form-control" id="exampleInputName1"
                                            placeholder="Nomor Induk Siswa">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Nama</label>
                                        <input type="text" name="nama" class="form-control" id="exampleInputEmail3"
                                            placeholder="Nama Lengkap">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Jenis Kelamin</label>
                                        <select class="form-control" name="gender" id="exampleSelectGender">
                                            <option selected disabled>Jenis Kelamin</option>
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputCity1">Kelas</label>
                                        <select class="form-control" name="id_kelas_siswa" id="exampleSelectGender">
                                            <option selected disabled>Pilih Kelas</option>
                                            @foreach($kelas as $kls)
                                            <option value="{{$kls->id_kelas}}">{{ $kls->nama_kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <a href="{{ url('/daftarSiswa')}}" class="btn btn-light">Cancel</a>
                                </form>
                             </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection