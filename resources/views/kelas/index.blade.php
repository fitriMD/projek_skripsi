@extends('layouts2.template')
@section('content')
<!-- partial -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <center>
                        <h2>Data Kelas</h2>
                    </center>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fa fa-institution"></i> Data Kelas</h4>
                        @if (Auth::user()->roles=='admin')
                        <a class="btn btn-success my-2" href="/createKelas" style="width: 125px; margin-left:0px;"><i class="fa fa-plus"></i>
                            Tambah</a>
                            @endif
                        <div class="table-responsive">
                            <table id="example" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Nama Kelas
                                        </th>
                                        <th>
                                            Wali Kelas
                                        </th>
                                        @if (Auth::user()->roles=='admin')
                                        <th>
                                            Action
                                        </th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($kelas as $kls)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $kls->nama_kelas }}</td>
                                        <td>{{ $kls->nama }}</td>
                                        @if (Auth::user()->roles=='admin')
                                        <td>
                                            <a href="{{ url('kelas/hapus/'. $kls->id_kelas) }}" class="btn btn-danger"
                                                onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')"><i
                                                    class="fa fa-trash"></i></a>
                                            <a href="{{ url('kelas/update/'. $kls->id_kelas) }}"
                                                class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                        </td>
                                        @endif
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
@push('js')
<script>
    $(function () {
      $('#example').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "responsive": true,
      });
    });
</script>
@endpush