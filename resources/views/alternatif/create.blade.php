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
                        <form method="post" action={{ url('/createalternatif') }} class="form-horizontal">
                            @csrf
                        <h4 class="card-title">Tambah Data</h4>
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputCity1">Nama Siswa</label>
                                <select class="form-control" name="id_siswa" id="exampleSelectGender">
                                    <option selected disabled>Pilih Siswa</option>
                                    @foreach($siswa as $sw)
                                    <option value="{{$sw->id_siswa}}">{{ $sw->nama }}</option>
                                    @endforeach
                                </select>                            
                            </div>
                            {{-- <div class="form-group">
                                <label for="exampleInputName1">Nama Siswa</label>
                                <input type="text" name="id_siswa" class="form-control" id="exampleInputName1" placeholder="Nama Siswa">
                            </div> --}}
                            <div class="form-group">
                                <label for="exampleInputEmail3">C1</label>
                                <input type="text" name="C1" class="form-control" id="exampleInputEmail3" placeholder="Rata-rata Nilai Rapor">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">C2</label>
                                <input type="text" name="C2" class="form-control" id="exampleInputEmail3" placeholder="Kedisiplinan">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">C3</label>
                                <input type="text" name="C3" class="form-control" id="exampleInputEmail3" placeholder="Ketidakhadiran">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">C4</label>
                                <input type="text" name="C4" class="form-control" id="exampleInputEmail3" placeholder="Keaktifan Dalam Kelas">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">C5</label>
                                <input type="text" name="C5" class="form-control" id="exampleInputEmail3" placeholder="Keberanian">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">C6</label>
                                <input type="text" name="C6" class="form-control" id="exampleInputEmail3" placeholder="Sopan Santun/Akhlak">
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