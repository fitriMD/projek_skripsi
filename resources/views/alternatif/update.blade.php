@extends('layouts2.template')
@section('content')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <center>
                        <h2>Data Alternatif</h2>
                        <h2><small>(Nilai kandidat siswa teladan sesuai kriteria)</small></h2>
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
                        <form method="post" action="{{ url('alternatif-update/' .$alternatif->id_alternatif) }}">
                        {{csrf_field()}}
                        <h4 class="card-title">Update Data Alternatif</h4>
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="id_siswa">Nama Siswa</label> 
                                <select class="form-control" id="id_user_walikelas" name="id_siswa">
                                    @foreach($siswa as $siswa)
                                    <option value="{{$siswa->id_siswa}}" @php if ( $siswa->id_siswa == $siswa->id_siswa ) echo 'selected="selected"'; @endphp>{{ $siswa->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="form-group">
                                <label for="nama">Nama Siswa</label>
                                <input type="text" name="id_siswa" class="form-control" id="id_siswa" placeholder="Nama" value="{{ $alternatif->id_siswa }}" aria-describedby="nama" required>
                            </div> --}}
                            <div class="form-group">
                                <label for="nama">Rata-rata Rapor (C1)</label>
                                <input type="text" name="C1" class="form-control" id="name" placeholder="Nama" value="{{ $alternatif->C1 }}" aria-describedby="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Kedisiplinan (C2)</label>
                                <input type="text" name="C2" class="form-control" id="name" placeholder="Nama" value="{{ $alternatif->C2 }}" aria-describedby="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Ketidakhadiran (C3)</label>
                                <input type="text" name="C3" class="form-control" id="name" placeholder="Nama" value="{{ $alternatif->C3 }}" aria-describedby="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Keaktifan dalam kelas (C4)</label>
                                <input type="text" name="C4" class="form-control" id="name" placeholder="Nama" value="{{ $alternatif->C4 }}" aria-describedby="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Keberanian (C5)</label>
                                <input type="text" name="C5" class="form-control" id="name" placeholder="Nama" value="{{ $alternatif->C5 }}" aria-describedby="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Sopan santun/akhlak (C6)</label>
                                <input type="text" name="C6" class="form-control" id="name" placeholder="Nama" value="{{ $alternatif->C6 }}" aria-describedby="nama" required>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                            <a href="{{ url('/daftarAlternatif')}}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection