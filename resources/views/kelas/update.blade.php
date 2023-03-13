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
                        <form method="post" action="{{ url('kelas-update/' .$kelas->id_kelas) }}">
                        {{csrf_field()}}
                        <h4 class="card-title">Update Data Kelas</h4>
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="nama">Nama Kelas</label>
                                <input type="text" name="nama_kelas" class="form-control" id="name" placeholder="Nama" value="{{ $kelas->nama_kelas }}" aria-describedby="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="id_user_walikelas">Wali Kelas</label> 
                                <select class="form-control" id="id_user_walikelas" name="id_user_walikelas">
                                    @foreach($waliKelas as $waliKelas)
                                    <option value="{{$waliKelas->id_user}}" @php if ( $waliKelas->id_user == $kelas->id_user_walikelas ) echo 'selected="selected"'; @endphp>{{ $waliKelas->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection