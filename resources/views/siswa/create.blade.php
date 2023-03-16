@extends('layouts.template')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
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
                        <form method="post" action={{ url('/createsiswa') }} class="form-horizontal">
                            @csrf
                        <h4 class="card-title">Tambah Data Siswa</h4>
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputName1">NIS</label>
                                <input type="text" name="nis" class="form-control" id="exampleInputName1" placeholder="Nomor Induk Siswa">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Nama</label>
                                <input type="text" name="nama" class="form-control" id="exampleInputEmail3" placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Jenis Kelamin</label>
                                <select class="form-control" name="gender" id="exampleSelectGender">
                                    <option selected disabled>Jenis Kelamin</option>
                                    <option value="L">Male</option>
                                    <option value="P">Female</option>
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
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection