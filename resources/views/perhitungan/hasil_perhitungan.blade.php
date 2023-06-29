@extends('layouts2.template')
@section('content')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <center>
                        <h2>Hasil Perhitungan</h2>
                        <p>Dengan menggunakan metode AHP dan TOPSIS sebelumnya, maka didapatkan hasil berupa
                            perangkingan nilai siswa dari yang terbesar ke terkecil
                        </p>
                    </center>
                </div>
            </div>
        </div>

        <div class="dark_bg full margin_bottom_30">
            <div class="dark_bg full margin_bottom_30">
                <div class="graph_head">
                    <div class="col-md-12">
                        <div class="card card-body">
                            <table id="example" class="table table-stripe">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Periode</th>
                                        <th>Dibuat pada</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $topsis->get() AS $index => $isi )
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $isi->nama_periode }}</td>
                                        <td>{{ date('d F Y H.i', strtotime($isi->created_at))}}</td>
                                        <td>
                                            <a href="{{ url('topsis/perangkingan/'. $isi->id_topsis) }}"
                                                class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('cetak_pdf', ['id_topsis'=>$isi->id_topsis,'id_periode'=>$isi->id_periode]) }}"
                                                class="btn btn-sm btn-primary"><i class="fa fa-download"></i></a>
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