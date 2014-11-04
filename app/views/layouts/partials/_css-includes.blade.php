<!-- Styles -->
{{ HTML::style('assets/css/bootstrap.min.css'); }}
<style>
	@font-face {
	  font-family: 'FontAwesome';
	  src: url('{{ asset("assets/font-awesome/fonts/fontawesome-webfont.eot?v=4.0.3"); }}');
	  src: url('{{ asset("assets/font-awesome/fonts/fontawesome-webfont.eot?#iefix&v=4.0.3"); }}') format('embedded-opentype'), url('{{ asset("assets/font-awesome/fonts/fontawesome-webfont.woff?v=4.0.3"); }}') format('woff'), url('{{ asset("assets/font-awesome/fonts/fontawesome-webfont.ttf?v=4.0.3"); }}') format('truetype'), url('{{ asset("assets/font-awesome/fonts/fontawesome-webfont.svg?v=4.0.3#fontawesomeregular"); }}') format('svg');
	  font-weight: normal;
	  font-style: normal;
	}
</style>
{{ HTML::style('assets/font-awesome/css/font-awesome.css'); }}

<!-- iCheck -->
{{ HTML::style('assets/css/plugins/iCheck/custom.css'); }}

<!-- Input Mask-->
{{ HTML::style('assets/css/plugins/jasny/jasny-bootstrap.min.css'); }}

<!-- Steps -->
{{ HTML::style('assets/css/plugins/steps/jquery.steps.css'); }}

<!-- Full Calendar -->
{{ HTML::style('assets/css/plugins/fullcalendar/fullcalendar.css'); }}
{{ HTML::style('assets/css/plugins/fullcalendar/fullcalendar.print.css'); }}

<!-- Date picker -->
{{ HTML::style('assets/css/plugins/datapicker/datepicker3.css'); }}

<!-- Styles -->
{{ HTML::style('assets/css/animate.css'); }}

<!-- DROPZONE -->
{{ HTML::style('assets/css/plugins/dropzone/basic.css'); }}
{{ HTML::style('assets/css/plugins/dropzone/dropzone.css'); }}

<!-- preimage -->
{{ HTML::style('assets/css/plugins/preimage/preimage.css'); }}

<!-- Styles -->
{{ HTML::style('assets/css/style.css'); }}

@yield('styles')