@section("footer")
    <footer id="footer">
      Gravity &copy; <?php echo date('Y') ?>. All Rights Reserved.
    </footer>
    {{ HTML::script('/assets/js/jquery-2.1.4.min.js') }}    
    {{ HTML::script('/assets/js/bootstrap.min.js') }}
    {{ HTML::script('/assets/js/plugins.js') }}
    {{ HTML::script('/assets/js/jquery.slicknav.js') }}
    {{ HTML::script('/assets/js/main.js') }}
        
    @yield('js')
@show