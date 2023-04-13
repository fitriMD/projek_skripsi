@extends('layouts2.template2')
@section('content')
<!-- dashboard inner -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Dashboard</h2>
                </div>
            </div>
        </div>
        <div class="row column1">
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30 yellow_bg">
                    <div class="couter_icon">
                        <div>
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no">{{ $users }}</p>
                            <p class="head_couter text-white">Users</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30 blue1_bg">
                    <div class="couter_icon">
                        <div>
                            <i class="fa fa-child"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no">{{$siswa}}</p>
                            <p class="head_couter text-white">Siswa</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30 green_bg">
                    <div class="couter_icon">
                        <div>
                            <i class="fa fa-institution"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no">{{$kelas}}</p>
                            <p class="head_couter text-white">Kelas</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30 red_bg">
                    <div class="couter_icon">
                        <div>
                            <i class="fa fa-bar-chart"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no">{{$kriteria}}</p>
                            <p class="head_couter text-white">Kriteria</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dark_bg full margin_bottom_30">
            <div class="dark_bg full margin_bottom_30">
                <div class="col-md-l2 col-lg-12">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2>Definition</h2>
                        </div>
                    </div>
                </div>
                <div class="full graph_revenue">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="content testimonial">
                                <div id="testimonial_slider" class="carousel slide" data-ride="carousel">
                                    <!-- Wrapper for carousel items -->
                                    <div class="carousel-inner">
                                        <div class="item carousel-item active">
                                            <div class="img-responsive"><img width="150" src="{{ asset('style2/images/logo.png')}}" alt=""></div>
                                            <p class="testimonial">Sistem Pendukung Keputusan (SPK) adalah 
                                                sistem komputer yang digunakan untuk membantu dalam membuat keputusan yang kompleks, 
                                                berdasarkan data yang tersedia. SPK menggunakan berbagai teknik komputasi, termasuk logika biner, 
                                                analisis jaringan, dan algoritma genetika, untuk membuat keputusan untuk masalah yang rumit. 
                                                Dengan menggunakan SPK, dapat menggunakan data yang lebih akurat untuk membuat keputusan yang lebih baik dan lebih cepat. 
                                                SPK juga memungkinkan untuk menentukan dampak dari setiap pilihan yang memungkinkan mereka membuat keputusan yang lebih bijaksana.</p>
                                            <p class="overview"><b>Sistem Pendukung Keputusan</b>(SPK)</p>
                                        </div>
                                        <div class="item carousel-item">
                                            <div class="img-responsive"><img src="{{ asset('style2/images/logoMI.png')}}" alt=""></div>
                                            <p class="testimonial">Sistem Pendukung Keputusan Pemilihan Siswa Teladan adalah sistem yang menggunakan teknologi 
                                                untuk membantu dalam memilih siswa teladan. Sistem ini dapat membantu sekolah dalam menilai dan menentukan 
                                                siswa teladan dengan membandingkan dan menganalisis beberapa kriteria yang ditentukan. 
                                                Sistem ini dapat membantu sekolah dalam menentukan siswa teladan yang paling cocok dengan kriteria yang ditentukan. 
                                                Sistem ini juga dapat membantu sekolah dalam menilai dan menentukan siswa teladan dengan membandingkan dan menganalisis 
                                                kriteria yang ditentukan. Sistem ini juga dapat menyediakan informasi yang akurat dan tepat tentang siswa teladan yang memenuhi syarat.</p>
                                            <p class="overview"><b>Sistem Pendukung Keputusan Pemilihan Siswa Teladan</b>SIKUNGKESDAN</p>
                                        </div>
                                        <div class="item carousel-item">
                                            <div class="img-box"><img src="{{ asset('style2/images/layout_img/user_img.jpg')}}" alt=""></div>
                                            <p class="testimonial">Sed ut perspiciatis unde omnis iste
                                                natus error sit voluptatem accusantium doloremque
                                                laudantium, totam rem aperiam, eaque ipsa quae..</p>
                                            <p class="overview"><b>Alur Pemilihan Siswa Teladan</b></p>
                                        </div>
                                    </div>
                                    <!-- Carousel controls -->
                                    <a class="carousel-control left carousel-control-prev" href="#testimonial_slider"
                                        data-slide="prev">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                    <a class="carousel-control right carousel-control-next" href="#testimonial_slider"
                                        data-slide="next">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row column3">
        </div>


       
        @if ( $topsis->count() != 0 )

        
        <div class="row column4 graph">
            <div class="col-md-12">
                <div class="dash_blog">
                    <div class="dash_blog_inner">
                        @php
                        $kolom = $topsis->first();
                        $json_relatif = json_decode( $kolom->jarak_relatif);
                        @endphp

                        <div class="dash_head">
                            <h3><span><i class="fa fa-bookmark"></i> Hasil Perangkingan</span><span class="plus_green_bt"></span></h3>
                        </div>
                        <div class="list_cont">
                            <p>Perangkingan Pemilihan Siswa Periode ........</p>
                        </div>
                        <div class="dropdown" style="width: 125px; margin-left:40px;">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Pilih Periode</button>
                            <div class="dropdown-menu">
                               <a class="dropdown-item" href="#">Dropdown link</a>
                               <a class="dropdown-item" href="#">Dropdown link</a>
                               <a class="dropdown-item" href="#">Dropdown link</a>
                            </div>
                         </div>
                        <div class="task_list_main">
                            <ul class="task_list">
                                @foreach ($json_relatif AS $no => $isi)
                                <li>
                                    <a href="#">Rangking {{ $no +1}}</a><br><strong>{{$isi->nama}} ({{number_format($isi->hasilJarak, 2)}})</strong>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endif
    </div>
</div>
<!-- end dashboard inner -->

@endsection