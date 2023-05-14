@extends('layouts2.template')
@section('content')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <center>
                        <h2>Data User</h2>
                        <h2><small>(Pengguna yang dapat login ke website SIKUNGKESDAN)</small></h2>
                    </center>
                </div>
            </div>
        </div>
        <div class="graph_revenue">
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
                            <form method="post" action={{ url('/createuser') }} class="form-horizontal">
                                @csrf
                                <h4 class="card-title">Tambah Data User</h4>
                                <form class="forms-sample">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Nama</label>
                                        <input type="text" name="nama" class="form-control" id="exampleInputName1"
                                            placeholder="Nama Lengkap">
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="username" name="username" class="form-control" id="username"
                                            placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control" name="roles" id="role">
                                            <option value="admin">Admin</option>
                                            <option value="kepala_sekolah">Kepala Sekolah</option>
                                            <option value="wali_kelas">Wali Kelas</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <a href="{{ url('/daftarUser')}}" class="btn btn-light">Cancel</a>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection