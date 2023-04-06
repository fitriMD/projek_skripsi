@extends('layouts.template')
@section('content')
<!-- partial -->

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        
        {{-- <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-body">
                    

                    @if ( $ahp->count() == 0 )

                        <div class="text-center">
                            @php echo svgku() @endphp 
                            <h2 style="margin: 0px">Perhitungan Kosong</h2>
                            <h4>Analytical Hierarchy Process (AHP)</h4>

                            <div>
                                <a href="{{ url('ahp/proses') }}" class="btn btn-success" onclick="return confirm('Apakah anda ingin melakukan proses perhitungan ?')">Hitung Sekarang</a>
                            </div>
                        </div>
                        

                    @else 
                        
                    <div class="row">
                        <div class="col-md-10">
                            <h4 style="margin: 0px">Analytical Hierarchy Process (AHP)</h4>
                            <p>Hasil perhitungan dari metode AHP</p>

                            @php 

                                $kolom = $ahp[0];
                                $json_matrix = json_decode($kolom->matrix_perbandingan);
                                $json_bobot = json_decode($kolom->bobot_prioritas);
                            @endphp 

                            <small>Terakhir diperbarui pada <b>{{ date('d F Y H.i', strtotime( $kolom->created_at )) }}</b></small>      

                            <hr>
                            <h3>A. Matrix Kolom</h3>
                            <p>Menentukan matriks perbandingan berpasangan (pair-wise comparison
                                matriks). Hasil perbandingan setiap elemen berupa angka dari 1 sampai 9
                                yang menunjukkan pentingnya item tersebut. Jika elemen dalam matriks
                                dibandingkan dengan dirinya sendiri, nilai 1 diberikan pada hasil
                                perbandingan</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>C1</th>
                                        <th>C2</th>
                                        <th>C3</th>
                                        <th>C4</th>
                                        <th>C5</th>
                                        <th>C6</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $json_matrix->m AS $baris )
                                    <tr>
                                        @foreach ($baris AS $isi)
                                        <td>{{ $isi }}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach 
                                </tbody>
                            </table>

                            <h3>B. Hasil Penjumlahan Kolom</h3>
                            <p>Menentukan matriks perbandingan berpasangan (pair-wise comparison
                                matriks). Hasil perbandingan setiap elemen berupa angka dari 1 sampai 9
                                yang menunjukkan pentingnya item tersebut. Jika elemen dalam matriks
                                dibandingkan dengan dirinya sendiri, nilai 1 diberikan pada hasil
                                perbandingan</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>C1</th>
                                        <th>C2</th>
                                        <th>C3</th>
                                        <th>C4</th>
                                        <th>C5</th>
                                        <th>C6</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        @foreach ( $json_matrix->m_hasil_penjumlahan AS $isi )
                                        <td>{{ $isi }}</td>
                                        @endforeach 
                                    </tr>
                                    
                                </tbody>
                            </table>
                            <h3>C. Normalisasi Matrix</h3>
                            <p>Membagi setiap nilai dari kolom dengan total kolom yang
                                bersangkutan untuk memperoleh bentuk normalisasi matriks sehingga
                                menghasilkan tabel sebagai berikut:</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>C1</th>
                                        <th>C2</th>
                                        <th>C3</th>
                                        <th>C4</th>
                                        <th>C5</th>
                                        <th>C6</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $json_matrix->m_normalisasi AS $baris )
                                    <tr>
                                        @foreach ($baris AS $isi)
                                        <td>{{ $isi }}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach 
                                </tbody>
                            </table>


                            <h3>D. Bobot Kriteria</h3>
                            <p>Menjumlahkan nilai-nilai dari setiap baris dan membaginya dengan
                                jumlah elemen untuk mendapatkan nilai rata-rata sehingga
                                menghasilkan seperti dibawah ini :</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>C1</th>
                                        <th>C2</th>
                                        <th>C3</th>
                                        <th>C4</th>
                                        <th>C5</th>
                                        <th>C6</th>
                                        <th>Jumlah</th>
                                        <th>Rata-rata (Bobot)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $json_matrix->m_normalisasi AS $baris )
                                    <tr>
                                        @php
                                        
                                            $jumlah = 0;
                                        @endphp 
                                        @foreach ($baris AS $isi)
                                        <td>{{ $isi }}</td>

                                            @php 
                                                $jumlah = $jumlah + $isi;
                                            @endphp 
                                        @endforeach
                                        <td>{{ $jumlah }}</td>
                                        <td>{{ number_format($jumlah / count( $baris ), 3) }}</td>
                                    </tr>
                                    @endforeach 
                                </tbody>
                            </table>

                        </div>
                        <div class="col-md-2">
                            <a class="btn btn-warning" href="{{ url('ahp/reset') }}" onclick="return confirm('Apakah anda ingin mereset ulang perhitungan AHP ?')">Hitung Ulang</a>
                        </div>

                        
                    </div>
                    @endif 
                </div>
            </div>
        </div> --}}
    </div>
</div>

@endsection