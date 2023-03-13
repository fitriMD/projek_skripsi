@extends('layouts.template')
@section('content')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Siswa</h4>
                        <a class="btn btn-success my-2" href="/createUser" style="width: 150px; margin-left:10px;"> Tambah User</a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            Nama
                                        </th>
                                        <th>
                                            NIS
                                        </th>
                                        <th>
                                            Jenis Kelamin
                                        </th>
                                        <th>
                                            Kelas
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $user)
                                    <tr>
                                        <td>{{ $user->nama }}</td>
                                        <td>{{ $user->nip }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->roles }}</td>
                                        <td>

                                            <a href="{{ url('users/hapus/'. $user->id_user) }}" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')"><i
                                                class="fa fa-trash"></i> Hapus</a>
                                            <a href="{{ url('users/update/'. $user->id_user) }}" class="btn btn-warning"><i
                                                    class="fa fa-trash"></i> Update</a>    
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