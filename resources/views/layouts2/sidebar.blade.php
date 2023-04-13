<nav id="sidebar">
    <div class="sidebar_blog_1">
       <div class="sidebar-header">
          <div class="logo_section">
             <a href="index.html"><img class="logo_icon img-responsive" src="images/logo/logo_icon.png" alt="#" /></a>
          </div>
       </div>
       <div class="sidebar_user_info">
          <div class="icon_setting"></div>
          <div class="user_profle_side">
             <div class="user_img"><img class="img-responsive" src="{{ asset('style2/images/user.png') }}" alt="#" /></div>
             <div class="user_info">
                <h6>{{ Auth::user()->nama }}</h6>
                <p><span class="online_animation"></span> Online</p>
             </div>
          </div>
       </div>
    </div>
    <div class="sidebar_blog_2">
       <h4>General</h4>
       <ul class="list-unstyled components">
          <li><a href="/dashboard"><i class="fa fa-dashboard green_color"></i> <span>Dashboard</span></a></li>
          <li><a href="/daftarPeriode"><i class="fa fa-clock-o orange_color"></i> <span>Periode</span></a></li>
          <li>
             <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-database purple_color"></i> <span>Master Data</span></a>
             <ul class="collapse list-unstyled" id="element">
                <li><a href="/daftarUser">> <span>Data User</span></a></li>
                <li><a href="/daftarKelas">> <span>Data Kelas</span></a></li>
                <li><a href="/daftarSiswa">> <span>Data Siswa</span></a></li>
             </ul>
          </li>
          <li class="active">
            <a href="#additional_page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-clone yellow_color"></i> <span>Data Perhitungan</span></a>
            <ul class="collapse list-unstyled" id="additional_page">
               <li>
                  <a href="/daftarKriteria">> <span>Data Kriteria</span></a>
               </li>
               <li>
                  <a href="/daftarAlternatif">> <span>Data Alternatif</span></a>
               </li>
            </ul>
         </li>
          <li>
             <a href="#apps" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-calculator blue2_color"></i> <span>Proses Perhitungan</span></a>
             <ul class="collapse list-unstyled" id="apps">
                <li><a href="/ahp">> <span>AHP</span></a></li>
                <li><a href="/topsis">> <span>TOPSIS</span></a></li>
             </ul>
          </li>
          <li><a href="tables.html"><i class="fa fa-folder-open purple_color2"></i> <span>Hasil Perhitungan</span></a></li>
          {{-- <li><a href="price.html"><i class="fa fa-briefcase blue1_color"></i> <span>Pricing Tables</span></a></li>
          <li>
             <a href="contact.html">
             <i class="fa fa-paper-plane red_color"></i> <span>Contact</span></a>
          </li>
          
          <li><a href="map.html"><i class="fa fa-map purple_color2"></i> <span>Map</span></a></li>
          <li><a href="charts.html"><i class="fa fa-bar-chart-o green_color"></i> <span>Charts</span></a></li>
          <li><a href="settings.html"><i class="fa fa-cog yellow_color"></i> <span>Settings</span></a></li> --}}
       </ul>
    </div>
 </nav>