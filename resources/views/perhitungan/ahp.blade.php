@extends('layouts2.template')
@section('content')
<!-- partial -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <center>
                        <h2>AHP (Analytical Hierarchy Process)</h2>
                        <p>Metode AHP digunakan untuk menentukan bobot setiap kriteria yang digunakan untuk
                            pemilihan siswa teladan</p>
                    </center>
                </div>
            </div>
        </div>
        <!-- partial -->
        <div class="dark_bg full margin_bottom_30">
            <div class="dark_bg full margin_bottom_30">
                <div class="graph_head">
                    <div class="col-md-12">
                        <div class="card card-body">
                            @if ( $ahp->count() == 0 )
                            <div class="text-center">
                                @php echo svgku() @endphp
                                <h4 style="margin: 0px">Perhitungan Kosong</h4>
                                <h4>Analytical Hierarchy Process (AHP)</h4>
                                <div>
                                    <a href="{{ url('ahp/proses') }}" class="btn btn-success"
                                        onclick="return confirm('Apakah anda ingin melakukan proses perhitungan ?')">Hitung
                                        Sekarang</a>

                                    {{-- <a href="javascript:;" data-toggle="modal" data-target="#tambah" class="btn btn-success">Hitung Sekarang</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                           <form action="{{ url('ahp/proses') }}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Tahun Ajaran / Periode</label>
                                                    <select class="form-control" name="id_periode" id="exampleSelectGender">
                                                        <option selected disabled>Pilih Periode</option>
                                                        @foreach($periode as $p)
                                                        <option value="{{$p->id_periode}}" @if ( $p->status == "aktif" ) selected="selected" @endif>{{ $p->nama_periode }}</option>
                                                        @endforeach
                                                    </select> 
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Proses Perhitungan</button>
                                            </div>
                                        </form>
                                        </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            @else
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- <div class="col-md-2 float-right">
                                        <a class="btn btn-warning" href="{{ url('ahp/reset') }}"
                                            onclick="return confirm('Apakah anda ingin mereset ulang perhitungan AHP ?')"><i
                                                class="fa fa-refresh"></i> Hitung Ulang</a>
                                    </div> --}}
                                    <h4 style="margin: 0px">Hasil perhitungan metode AHP</h4>
                                    @php

                                    $kolom = $ahp[0];
                                    $json_matrix = json_decode($kolom->matrix_perbandingan);
                                    $json_bobot = json_decode($kolom->bobot_prioritas);
                                    @endphp

                                    {{-- <small>Terakhir diperbarui pada <b>{{ date('d F Y H.i', strtotime( $kolom
                                            >created_at
                                            ))
                                            }}</b></small> --}}

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
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>B. Hasil Penjumlahan Kolom</h3>
                                    <p>Menjumlahkan nilai-nilai dari setiap kolom pada matriks perbandingan berpasangan</p>
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
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-md-12">
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
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-md-12">

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
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>



@php

function svgku() {

return '<svg style="width: 200px" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1"
    viewBox="0 0 689.16222 554.20406" xmlns:xlink="http://www.w3.org/1999/xlink">
    <polygon points="479.89 539.425 467.133 539.424 461.065 490.221 479.892 490.221 479.89 539.425" fill="#ffb6b6" />
    <path d="M694.48,689.55l-13.62-5.54-.39-.16-7.52,5.7a16.01266,16.01266,0,0,0-16.01,16.01v.52h41.13V689.55Z"
        transform="translate(-214.9307 -154.29167)" fill="#2f2e41" />
    <polygon points="595.153 522.84 583.736 528.53 556.355 487.2 573.206 478.802 595.153 522.84" fill="#ffb6b6" />
    <path
        d="M811.14,671.95,808.22,673.4l-.3.15L793.28,674.68l-.44.03-4.19,8.45A16.00178,16.00178,0,0,0,781.47,704.63l.23.46,36.81-18.34Z"
        transform="translate(-214.9307 -154.29167)" fill="#2f2e41" />
    <path
        d="M686.16872,429.25033l70.34118,2.462L757,431s6,14,6,26c0,3.98978-2.77482,30.0849-1.36422,35.022.17544.614-1.03161,2.11871-.63578,4.978.25685,1.85534,1.67424.42823,2,3,.23381,1.84584-2.261,2.86483-2,5,.28513,2.33265,3.71686,9.88884,4.02575,12.48363,3.28871,27.62609,7.66741,67.64782,7.66741,67.64782S790.27972,632.23486,794,633c6.24457,1.2843,10.46045,12.63861,7,15-1.64777,1.12445-22.94452,8.6886-22.94452,8.6886-1.17017.21173-4.83093-1.62445-2.49884-5.96655.42932-.79932-2.1311,1.23489-2.55664.278-.45254-1.01764.43581-5.067-.08247-6.19651-4.65427-10.14333-11.80011-24.19972-18.57183-31.41769a68.60119,68.60119,0,0,1-18.08478-38.7651L720.7284,488.4955l-5.32347,24.15171L711,517l1.20845,10.14911L712,537l-11,41s-1.64972,76.56842,1,79c1.43506,1.31689,7.52454,17.5379-4,19l-20.93824-1.61542s-2.8212-5.94506-1.4106-8.061,1.326-1.53833-.395-5.001-1.01563-9.33-1.01563-9.33A691.2062,691.2062,0,0,1,671,569c1.04967-45.503,7.41043-97.777,7.41043-98.84229a7.035,7.035,0,0,0-.5859-3.173v-2.87206l2.7018-10.17686Z"
        transform="translate(-214.9307 -154.29167)" fill="#2f2e41" />
    <circle cx="570.22498" cy="255.78" r="27.78" fill="#00bfa6" />
    <path
        d="M781.36592,424.52987a3.08927,3.08927,0,0,1-2.47187-1.23631l-7.57881-10.10525a3.09007,3.09007,0,1,1,4.94424-3.70792l4.95831,6.61058,12.7348-19.10194a3.0902,3.0902,0,1,1,5.1424,3.42827l-15.15762,22.73643a3.09148,3.09148,0,0,1-2.48544,1.37513C781.42326,424.52936,781.39459,424.52987,781.36592,424.52987Z"
        transform="translate(-214.9307 -154.29167)" fill="#fff" />
    <path
        d="M798.89236,439.44015a7.98812,7.98812,0,0,0-7.3119-9.827l-14.23431-48.4981-9.62944,11.17489,15.3201,45.409a8.03141,8.03141,0,0,0,15.85555,1.74121Z"
        transform="translate(-214.9307 -154.29167)" fill="#ffb8b8" />
    <path
        d="M788.85,415.78,787,409l2.12-4.05-.16-.47-.64-1.82L785,400l1.19-3.39-4.2-11.93-1.03-2.07L756.85,334.2l-5.78-11.61-1.34-2.1-4.17-6.54-5.7-8.93a12.74945,12.74945,0,0,0-8.08-5.63,12.94873,12.94873,0,0,0-1.62006-.25l-.38995-.03a12.87134,12.87134,0,0,0-2.91.17h-.02a12.47555,12.47555,0,0,0-4.74,1.88,12.74026,12.74026,0,0,0-2.98,2.68,12.90512,12.90512,0,0,0-2.85,8.55l.18,4.88.18,4.44L725.09,337.01l.55,1,.01.03,26.03,47.1,7.85,14.2L760.72,401.5,766,405l-1.41,3.52L765,414l4.49,3.39L776,424l.26.54,2-1.01.19-.1.45-.13,6.19-1.87,3.76-1.13.12-.04L790,420Z"
        transform="translate(-214.9307 -154.29167)" fill="#e6e6e6" />
    <path
        d="M895.86,635.94a15.26465,15.26465,0,0,0-16.3-5.21l-.64.19-5.74,22.41c-.86-3.34-2.7-10.88-3.86-18.26l-.1-.61005-.56995.25a77.84167,77.84167,0,0,0-16.79,10.12,80.525,80.525,0,0,0-30.11,60.64l-.01.43-.01.27.76-.27L838.8,700.07a48.6883,48.6883,0,0,0,39.26-14.64c6.59-6.95,11.11-15.89,15.48-24.54,1.28-2.52,2.59-5.12,3.93-7.62A15.517,15.517,0,0,0,895.86,635.94Z"
        transform="translate(-214.9307 -154.29167)" fill="#f2f2f2" />
    <polygon
        points="262.385 109.64 260.385 109.64 260.385 32.597 405.042 32.597 405.042 34.597 262.385 34.597 262.385 109.64"
        fill="#3f3d56" />
    <circle cx="427.22498" cy="27.78" r="27.78" fill="#00bfa6" />
    <path
        d="M638.36592,196.52987a3.08927,3.08927,0,0,1-2.47187-1.23631l-7.57881-10.10525a3.09007,3.09007,0,1,1,4.94424-3.70792l4.95831,6.61058,12.7348-19.10194a3.0902,3.0902,0,1,1,5.1424,3.42827l-15.15762,22.73643a3.09148,3.09148,0,0,1-2.48544,1.37513C638.42326,196.52936,638.39459,196.52987,638.36592,196.52987Z"
        transform="translate(-214.9307 -154.29167)" fill="#fff" />
    <polygon
        points="164.385 296.685 162.385 296.685 162.385 373.728 307.042 373.728 307.042 371.728 164.385 371.728 164.385 296.685"
        fill="#3f3d56" />
    <circle cx="329.22498" cy="373.78" r="27.78" fill="#00bfa6" />
    <path
        d="M540.36592,542.52987a3.08927,3.08927,0,0,1-2.47187-1.23631l-7.57881-10.10525a3.09007,3.09007,0,1,1,4.94424-3.70792l4.95831,6.61058,12.7348-19.10194a3.0902,3.0902,0,1,1,5.1424,3.42827l-15.15762,22.73643a3.09148,3.09148,0,0,1-2.48544,1.37513C540.42326,542.52936,540.39459,542.52987,540.36592,542.52987Z"
        transform="translate(-214.9307 -154.29167)" fill="#fff" />
    <path
        d="M764,453.81a18.11307,18.11307,0,0,1-1,6.19l-.15-.03c-17.76081,3.07172-33.604,3.57456-40.93329-7.32742-9.562-12.17578-22.715-12.038-37.38666-6.69254l-1.74-1.88-2.96-3.19,2.72-3.08-2.72-5.94,2.27-7.33L685,424l-.78-6.31L683,414l3.58-3.93,3.04-9.81-2.19-20.53a136.76057,136.76057,0,0,1,16.62-81.22l8.31-7.46,3.45-3.1,4.63-8.64,4.89.57,13.24,1.53.45,1.08,3.25,7.84,17.12,18.39-.77,7.76-.34,3.42-.25,2.46L756.85,334.2l-4.81,48.37-.36,2.57-3.87,27.81c6.29,6.08,11.85,17.79,14.52,28.49.3,1.19-.55,2.4-.33,3.56.31,1.64,1.66,3.2,1.81,4.73A36.37237,36.37237,0,0,1,764,453.81Z"
        transform="translate(-214.9307 -154.29167)" fill="#e6e6e6" />
    <circle cx="515.16092" cy="98.92528" r="22.99621" fill="#ffb6b6" />
    <path
        d="M757.8129,246.94331c-1.36111-4.24309-5.09446-7.83317-9.5257-8.30232a15.51161,15.51161,0,0,0-22.738-15.50289,4.82341,4.82341,0,0,0-4.43137-1.684,9.9457,9.9457,0,0,0-4.501,1.97209,22.32129,22.32129,0,0,0-8.92844,21.11147c-.01017-2.02774.88812,1.8953,3.46377,2.242a16.98977,16.98977,0,0,1,6.01723,2.482,17.5052,17.5052,0,0,0,6.00511,2.51707c2.16133.31613,2.7185,8.98,1.17479,14.56008-.29258,1.05749-.4412,2.47639.53344,2.98032,1.20026.62066,2.41353-.93974,3.75632-1.09191a2.32517,2.32517,0,0,1,2.35867,2.20684,3.79078,3.79078,0,0,1-1.58272,3.08913,11.20227,11.20227,0,0,1-3.23565,1.5675l.38768.55043a3.08007,3.08007,0,0,0,3.62818,1.47875c1.53772,1.85489,17.38471-3.2955,18.15747-6.68106a37.4027,37.4027,0,0,0,8.13841-10.51292A17.8695,17.8695,0,0,0,757.8129,246.94331Z"
        transform="translate(-214.9307 -154.29167)" fill="#2f2e41" />
    <path
        d="M776.41,316.98c-.31994,2.68-2.83,4.68-5.47,5.24a11.83217,11.83217,0,0,1-4.07.07,27.7599,27.7599,0,0,1-3.9-.87Q760.6,320.745,758.28,319.9a74.34057,74.34057,0,0,1-12.72-5.95,75.23243,75.23243,0,0,1-8.76-5.98q-2.16-1.71-4.19-3.57l1.69.8q-2.265-3.045-4.53-6.09-2.19-2.94-4.37-5.88c-.09-.12-.16-.2-.19-.24v-.01c-.67-.89-1.33-1.78-1.99-2.67-1.99-2.67-3.94995-6.59-1.66-9a4.29232,4.29232,0,0,1,3.73-1.13,5.9393,5.9393,0,0,1,2.05.66,14.46157,14.46157,0,0,1,4.35,4.39c1.56-2.27,4.59-3.11,7.33-2.74.15.01.29.03.43.05,2.85.49,4.08-1.05,6.55.46,1.15.7,1.85,4.3,3,5,.65.4,3.06,1,3.72,1.41,1.30005.8.97,3.79,2.28,4.59.97.59,3.57-1,4.54-.41,1.02.63,2.44,4.79,3.46,5.41,2.03,1.25,3.66-1.03,5.69.21,2.61,1.61005,5.39,3.4,6.49,6.26.97,2.52-.28,5.97-2.69,6.69A4.46616,4.46616,0,0,1,776.41,316.98Z"
        transform="translate(-214.9307 -154.29167)" fill="#e6e6e6" />
    <path
        d="M758.28,319.9l-.25,2.46a33.96274,33.96274,0,0,1-8.30005-1.87A17.53448,17.53448,0,0,1,741,314c-1.36-2.04-2.78-4.07-4.2-6.03-2.36-3.28-4.7-6.34-6.64-8.83-2.37-3.01-4.15-5.19-4.76-5.91-.09-.12-.16-.2-.19-.24l-.03-.03.03.02c11.882,15.03848,23.10535,23.71045,33.41,23.5C758.62,316.48,759.83,320.46,758.28,319.9Z"
        transform="translate(-214.9307 -154.29167)" opacity="0.2" />
    <path
        d="M649.54455,199.47177a7.98815,7.98815,0,0,0,7.12039,9.96664l13.29325,48.76444,9.84386-10.98648-14.4386-45.69692a8.03141,8.03141,0,0,0-15.8189-2.04768Z"
        transform="translate(-214.9307 -154.29167)" fill="#ffb8b8" />
    <path
        d="M727.59,324.17l-.09-4.44-8.38-15.89-.31-.58-.02-.03-6.43-12.18-31.0275-58.826L678,231l.1666-4.77836L678,221l-4.00316-2.68394L672.29,215.08l-2.42.69h-.01l-.07.02-10.58,2.97h-.01L657,220l-2,6-.43785,2.84056L655,234l5,1-1.65642,5.29044L663.37,255.51c6.29,26.6,14.88,49.56,29.71,62.67l1.22,2,9.65,15.79a12.80565,12.80565,0,0,0,12.89,5.99h.01a12.68313,12.68313,0,0,0,4.78-1.78,12.49451,12.49451,0,0,0,3.46-3.17,12.88365,12.88365,0,0,0,2.59-7.95Z"
        transform="translate(-214.9307 -154.29167)" fill="#e6e6e6" />
    <path
        d="M902.90224,708.1884l-271.75.30733a1.19068,1.19068,0,0,1,0-2.38137l271.75-.30733a1.19068,1.19068,0,0,1,0,2.38137Z"
        transform="translate(-214.9307 -154.29167)" fill="#cacaca" />
    <path
        d="M298.55912,308a58.77888,58.77888,0,0,1,16.04834-40.42676l-35.42334-48.75537a17.27493,17.27493,0,0,0-26.06348-2.19678,126.47218,126.47218,0,0,0-38.18994,90.95508,128.78525,128.78525,0,0,0,1.42725,19.11817,17.39208,17.39208,0,0,0,8.05713,12.231,17.20044,17.20044,0,0,0,14.38232,1.728l61.16553-19.874A59.15048,59.15048,0,0,1,298.55912,308Z"
        transform="translate(-214.9307 -154.29167)" fill="#f2f2f2" />
    <path
        d="M301.81205,327.31885l-63.58984,20.66162a17.25669,17.25669,0,0,0-10.1919,24.00635,127.485,127.485,0,0,0,94.86133,69.62353,17.29333,17.29333,0,0,0,13.89307-3.97265,17.25258,17.25258,0,0,0,6.022-13.1045V365.14062A59.11375,59.11375,0,0,1,301.81205,327.31885Z"
        transform="translate(-214.9307 -154.29167)" fill="#e6e6e6" />
    <path
        d="M493.04349,364.42773a19.26609,19.26609,0,0,0-11.80517-10.8457l-69.353-22.53418a59.04575,59.04575,0,0,1-47.06885,35.4917v72.25928a19.24418,19.24418,0,0,0,22.16944,19.01074,141.91776,141.91776,0,0,0,105.59863-77.50391A19.08863,19.08863,0,0,0,493.04349,364.42773Z"
        transform="translate(-214.9307 -154.29167)" fill="#3f3d56" />
    <path
        d="M475.813,198.68506a19.22962,19.22962,0,0,0-29.01368,2.44531l-47.415,65.26123A58.81036,58.81036,0,0,1,416.55912,308c0,1.437-.06934,2.85645-.17041,4.26758l75.36914,24.48926a19.26508,19.26508,0,0,0,24.979-15.53907,143.32936,143.32936,0,0,0,1.58887-21.2832A140.78836,140.78836,0,0,0,475.813,198.68506Z"
        transform="translate(-214.9307 -154.29167)" fill="#00bfa6" />
    <path
        d="M357.55912,249a58.706,58.706,0,0,1,28.9668,7.60645l28.93994-39.83252a17.33718,17.33718,0,0,0,2.83545-14.249,16.99427,16.99427,0,0,0-8.791-11.2041,127.62618,127.62618,0,0,0-115.3789-.168,17.4365,17.4365,0,0,0-9.09375,11.47071,17.18636,17.18636,0,0,0,2.80957,14.15332l32.83007,45.187A58.7338,58.7338,0,0,1,357.55912,249Z"
        transform="translate(-214.9307 -154.29167)" fill="#e6e6e6" />
</svg>';
}

@endphp
@endsection