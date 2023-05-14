@extends('layouts2.template')
@section('content')
<!-- partial -->
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
                        <form method="post" action="{{ url('user-update/' .$user->id_user) }}">
                        {{csrf_field()}}
                        <h4 class="card-title">Update Data User</h4>
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control" id="name" placeholder="Nama" value="{{ $user->nama }}" aria-describedby="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="{{ $user->username }}" aria-describedby="username" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Password</label>
                                <input type="text" name="password" class="form-control" id="password" placeholder="password" value="{{ $user->password }}" aria-describedby="password" required>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label> 
                                <select class="form-control" id="roles" name="roles">
                                    <option value="admin" @php if ( $user->roles == "admin" ) echo 'selected="selected"'; @endphp>Admin</option>
                                    <option value="kepala_sekolah" @php if ( $user->roles == "kepala_sekolah" ) echo 'selected="selected"'; @endphp>Kepala Sekolah</option>
                                    <option value="wali_kelas" @php if ( $user->roles == "wali_kelas" ) echo 'selected="selected"'; @endphp>Wali Kelas</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                            <a href="{{ url('/daftarUser')}}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection