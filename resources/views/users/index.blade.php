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
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fa fa-user"></i> Data User</h4>
                        <a class="btn btn-success my-2" href="/createUser" style="width: 125px; margin-left:0px;"><i class="fa fa-plus"></i> Tambah</a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Nama
                                        </th>
                                        <th>
                                            Username
                                        </th>
                                        <th>
                                            Role
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($user as $user)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $user->nama }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->roles }}</td>
                                        <td>

                                            <a href="{{ url('users/hapus/'. $user->id_user) }}" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')"><i
                                                class="fa fa-trash"></i></a>
                                            <a href="{{ url('users/update/'. $user->id_user) }}" class="btn btn-warning"><i
                                                    class="fa fa-edit"></i></a>    
                                            {{-- <form action="{{ route('users.destroy/' . $user->id) }}" method="POST">
                                                <form action="{{ url('fitri',$user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')"><i
                                                        class="fa fa-times"></i></button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection