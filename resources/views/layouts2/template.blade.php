<!DOCTYPE html>
<html lang="en">
@include('layouts2.header')

<body>
   <div class="full_container">
      <div class="inner_container">
         <!-- Sidebar  -->
         @include('layouts2.sidebar')
         <!-- end sidebar -->
         <!-- right content -->
         <div id="content">
            <!-- topbar -->
            @include('layouts2.navbar')
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
   <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
   @include('sweetalert::alert')
   @stack('js')
</body>

</html>