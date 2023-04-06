@extends('layouts.template')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-sm-3 stretch-card grid-margin">
      <div class="card bg-success text-white">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div class="card-title text-white">
              <h3 class="font-weight-bold mb-0">User</h3>
            </div>
          </div>
          <i class="mdi mdi-folder-account text-white mr-0 mr-sm-6 icon-lg"></i>
          <div>
            <h5 class="font-weight-bold mb-0">Total : {{ $users }}</h5>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-3 stretch-card grid-margin">
      <div class="card bg-info text-white">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div class="card-title text-white">
              <h3 class="font-weight-bold mb-0">Calon Siswa Teladan</h3>
            </div>
          </div>
          <i class="mdi mdi mdi-account-multiple mr-0 mr-sm-6 icon-lg"></i>
          <div>
            <h5 class="font-weight-bold mb-0">Total : {{$siswa}} </h5>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-3 stretch-card grid-margin">
      <div class="card bg-secondary text-white">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div class="card-title text-white">
              <h3 class="font-weight-bold mb-0">Kelas</h3>
            </div>
          </div>
          <i class="mdi mdi-folder mr-0 mr-sm-6 icon-lg"></i>
          <div>
            <h5 class="font-weight-bold mb-0">Total : {{$kelas}} </h5>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-3 stretch-card grid-margin">
      <div class="card bg-dark text-white">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div class="card-title text-white">
              <h3 class="font-weight-bold mb-0">Kriteria</h3>
            </div>
          </div>
          <i class="mdi mdi-poll mr-0 mr-sm-6 icon-lg"></i>
          <div>
            <h5 class="font-weight-bold mb-0">Total : {{$kriteria}} </h5>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><h2> Pendukung Keputusan Pemilihan Siswa Teladan</h2></h4>
          <p class="card-description">
            Use class <code>.text-primary</code>, <code>.text-secondary</code> etc. for text in theme colors
          </p>
          <div class="row">
            <div class="col-md-12 stretch-card">
              <p class="text-light pl-1" >
                <h4 style="line-height: 30px"> Pendukung Keputusan (SPK) Pemilihan Siswa Teladan adalah sistem yang digunakan untuk 
                mengidentifikasi siswa terbaik di sekolah. Sistem ini menggabungkan data seperti nilai akademik (Rata-rata rapor), 
                Kedisiplinan, ketidakhadiran, keaktifan dalam kelas, dan lainnya untuk menentukan siswa yang layak dipilih sebagai teladan. 
                Sistem ini juga dapat menetapkan kriteria pemilihan siswa teladan baru. Sistem Pendukung Keputusan Pemilihan Siswa Teladan 
                juga dapat membantu pihak sekolah dalam membuat keputusan yang tepat dalam memilih siswa teladan sesuai dengan kriteria yang telah ditetapkan. 
                Pada SPK ini digunakan penggabungan metode <mark>AHP (<i>Analitycal Hierarchy Process</i>)</mark> dan <mark>TOPSIS (<i>Technique for Orders Preference by Similarity to Ideal Solution</i></mark>). 
                Metode AHP digunakan untuk perhitungan bobot setiap kriteria dan untuk perangkingan menggunakan metode TOPSIS.</h4></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12 stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><h2>Hasil Perangking Siswa Teladan</h2></h4>
          <p class="card-description">
            Add class <code>.table-{color}</code>
          </p>
          <div class="table-responsive pt-3">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>
                    No
                  </th>
                  <th>
                    Nomor Induk Siswa
                  </th>
                  <th>
                    Nama Lengkap
                  </th>
                  <th>
                    Kelas
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr class="table-info">
                  <td>
                    1
                  </td>
                  <td>
                    Herman Beck
                  </td>
                  <td>
                    Photoshop
                  </td>
                  <td>
                    $ 77.99
                  </td>
                </tr>
                <tr class="table-warning">
                  <td>
                    2
                  </td>
                  <td>
                    Messsy Adam
                  </td>
                  <td>
                    Flash
                  </td>
                  <td>
                    $245.30
                  </td>
                </tr>
                <tr class="table-danger">
                  <td>
                    3
                  </td>
                  <td>
                    John Richards
                  </td>
                  <td>
                    Premeire
                  </td>
                  <td>
                    $138.00
                  </td>
                </tr>
                <tr class="table-success">
                  <td>
                    4
                  </td>
                  <td>
                    Peter Meggik
                  </td>
                  <td>
                    After effects
                  </td>
                  <td>
                    $ 77.99
                  </td>
                </tr>
                <tr class="table-primary">
                  <td>
                    5
                  </td>
                  <td>
                    Edward
                  </td>
                  <td>
                    Illustrator
                  </td>
                  <td>
                    $ 160.25
                  </td>
                  
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection