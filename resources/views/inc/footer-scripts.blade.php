
@livewireScripts

<script src="{{ asset('theme/dro-v1/js/jquery.min.js') }}"></script>
<script src="{{ asset('theme/dro-v1/js/slick.min.js') }}"></script>
<script src="{{ asset('theme/dro-v1/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('theme/dro-v1/js/jquery.isotope.min.js') }}"></script>
<script src="{{ asset('theme/dro-v1/js/easypiechart.js') }}"></script>
<script src="{{ asset('theme/dro-v1/js/particles.min.js') }}"></script>
<script src="{{ asset('theme/dro-v1/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('theme/dro-v1/js/scripts.js') }}"></script>
<script src="{{ asset('theme/dro-v1/js/header-mobile.js') }}"></script>

{{-- <script src="{{ asset('theme/dro-v1/js/royal_preloader.min.js') }}"></script>
--}}



@stack('footer-scripts')
@include('sweetalert::alert')
</body>
</html>
