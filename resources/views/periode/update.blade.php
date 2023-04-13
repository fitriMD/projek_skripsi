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
                        <form method="post" action="{{ url('periode-update/' .$periode->id_periode) }}">
                        {{csrf_field()}}
                        <h4 class="card-title">Update Data Periode</h4>
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="nama">Nama Periode</label>
                                <input type="text" name="nama_periode" class="form-control" id="name" placeholder="Nama" value="{{ $periode->nama_periode }}" aria-describedby="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label> 
                                <select class="form-control" id="status" name="status">
                                    <option value="aktif" @php if ( $periode->status == "aktif" ) echo 'selected="selected"'; @endphp>Aktif</option>
                                    <option value="tidak_aktif" @php if ( $periode->status == "tidak_aktif" ) echo 'selected="selected"'; @endphp>Tidak Aktif</option>
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