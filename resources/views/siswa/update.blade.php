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
                            <form method="post" action="{{ url('siswa-update/' .$siswa->id_siswa) }}">
                                {{csrf_field()}}
                                <h4 class="card-title">Update Data Siswa</h4>
                                <form class="forms-sample">
                                    <div class="form-group">
                                        <label for="periode">Periode</label>
                                        <select class="form-control" id="id_periode" name="id_periode">
                                            @foreach($periode as $p)
                                            <option value="{{$p->id_periode}}" @php if ( $p->id_kelas ==
                                                $siswa->id_periode ) echo 'selected="selected"'; @endphp>{{
                                                $p->nama_periode }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama Siswa</label>
                                        <input type="text" name="nama" class="form-control" id="name" placeholder="Nama"
                                            value="{{ $siswa->nama }}" aria-describedby="nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nomor Induk Siswa</label>
                                        <input type="text" name="nis" class="form-control" id="name" placeholder="Nama"
                                            value="{{ $siswa->nis }}" aria-describedby="nis" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Jenis Kelamin</label>
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="L" @php if ( $siswa->gender == "L" ) echo
                                                'selected="selected"'; @endphp>L</option>
                                            <option value="P" @php if ( $siswa->gender == "P" ) echo
                                                'selected="selected"'; @endphp>P</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="kelas">Kelas</label>
                                        <select class="form-control" id="id_kelas_siswa" name="id_kelas_siswa">
                                            @foreach($kelas as $kls)
                                            <option value="{{$kls->id_kelas}}" @php if ( $kls->id_kelas ==
                                                $siswa->id_kelas_siswa ) echo 'selected="selected"'; @endphp>{{
                                                $kls->nama_kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                    <a href="{{ url('/daftarSiswa')}}" class="btn btn-light">Cancel</a>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection