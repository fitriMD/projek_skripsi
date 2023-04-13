<!DOCTYPE html>
<html lang="en">
@include('layouts2.header2')

<body>
   <div class="full_container">
      <div class="inner_container">
         <!-- Sidebar  -->
         @include('layouts2.sidebar')
         <!-- end sidebar -->
         <!-- right content -->
         <div id="content">
            <!-- topbar -->
            @include('layouts2.navbar2')
            <!-- end topbar -->
            <!-- dashboard inner -->
            <div class="midde_cont">
               @yield('content')
               <!-- footer -->
               @include('layouts2.footer')
            </div>
            <!-- end dashboard inner -->
         </div>
      </div>
   </div>
</body>

</html>