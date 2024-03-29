@extends('layouts2.template')
@section('content')
<!-- partial -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <center>
                        <h2>Data Siswa</h2>
                        <h2><small>(Kandidat Siswa Teladan)</small></h2>
                    </center>
                </div>
            </div>
        </div>
        <div class="row column2 graph margin_bottom_30">
            <div class="col-md-l2 col-lg-12">
                <div class="white_shd full">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa fa-users"></i> Data Siswa</h4>
                            @if ((Auth::user()->roles=='admin') || (Auth::user()->roles == 'wali_kelas')) 
                            <a class="btn btn-success my-2" href="/createSiswa"
                                style="width: 125px; margin-left:0px;"><i class="fa fa-plus"></i> Tambah</a>
                            
                            <a class="btn btn-info my-2" href="/dataSiswa/cetak_pdf"
                                style="width: 125px; margin-left:10px;"><i class="fa fa-download"></i> Cetak</a>
                            @endif
                            <div class="table-responsive">
                                <table id="example" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>
                                                No
                                            </th>
                                            <th>
                                                Periode Pemilihan
                                            </th>
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
                                            @if ((Auth::user()->roles=='admin') || (Auth::user()->roles == 'wali_kelas')) 
                                            <th>
                                                Action
                                            </th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($siswa as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ Auth::user()->roles=='wali_kelas'? $data->periode->nama_periode : $data->nama_periode }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->nis }}</td>
                                            <td>{{ $data->gender }}</td>
                                            <td>{{ Auth::user()->roles=='wali_kelas'? $data->kelas->nama_kelas : $data->nama_kelas }}</td>
                                            @if ((Auth::user()->roles=='admin') || (Auth::user()->roles == 'wali_kelas')) 
                                            <td>

                                                <a href="{{ url('siswa/hapus/'. $data->id_siswa) }}"
                                                    class="btn btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')"><i
                                                        class="fa fa-trash"></i> </a>
                                                <a href="{{ url('siswa/update/'. $data->id_siswa) }}"
                                                    class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{-- {{ $siswa->links() }} --}}
                            </div>
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