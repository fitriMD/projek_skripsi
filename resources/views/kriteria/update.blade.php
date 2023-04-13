@extends('layouts2.template')
@section('content')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <center>
                        <h2>Data Kriteria</h2>
                        <h2><small>(Kriteria yang digunakan dalam pemilihan siswa teladan)</small></h2>
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
                        <form method="post" action="{{ url('kriteria-update/' .$kriteria->id_kriteria) }}">
                        {{csrf_field()}}
                        <h4 class="card-title">Update Data Kriteria</h4>
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="nama">Nama Kriteria</label>
                                <input type="text" name="nm_kriteria" class="form-control" id="nm_kriteria" placeholder="Nama Kriteria" value="{{ $kriteria->nm_kriteria }}" aria-describedby="nm_kriteria" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Variabel</label>
                                <input type="text" name="variabel" class="form-control" id="exampleInputEmail3" placeholder="Variabel" value="{{ $kriteria->variabel }}" aria-describedby="variabel" required>
                            </div>
                            <div class="form-group">
                                <label for="tipe">Tipe</label> 
                                <select class="form-control" id="tipe" name="tipe">
                                    <option value="benefit" @php if ( $kriteria->tipe == "benefit" ) echo 'selected="selected"'; @endphp>Benefit</option>
                                    <option value="cost" @php if ( $kriteria->tipe == "cost" ) echo 'selected="selected"'; @endphp>Cost</option>                            
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