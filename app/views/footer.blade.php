@section("footer")
    <footer id="footer">
      Gravity &copy; <?php echo date('Y') ?>. All Rights Reserved.
    </footer>
    {{ HTML::script('/assets/js/footer.js') }}
    
    @yield('js')
@show