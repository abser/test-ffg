@section("footer")
    <footer id="footer">
      Gravity &copy; <?php echo date('Y') ?>. All Rights Reserved.
    </footer>
        {{ HTML::script('/min/?g=common_js_footer') }} 
    
    @yield('js')
@show