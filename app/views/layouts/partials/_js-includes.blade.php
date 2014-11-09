<!-- Mainly scripts -->
{{ HTML::script('assets/js/jquery-1.10.2.js'); }}
{{ HTML::script('assets/js/bootstrap.min.js'); }}
{{ HTML::script('assets/js/plugins/metisMenu/jquery.metisMenu.js'); }}

<!-- Custom and plugin javascript -->
{{ HTML::script('assets/js/inspinia.js'); }}
{{ HTML::script('assets/js/plugins/pace/pace.min.js'); }}
{{ HTML::script('assets/js/jquery-ui.custom.min.js'); }}

<!-- DROPZONE -->
{{ HTML::script('assets/js/plugins/dropzone/dropzone.js'); }}

<!-- Input Mask-->
{{ HTML::script('assets/js/plugins/jasny/jasny-bootstrap.min.js'); }}

<!-- Date picker -->
{{ HTML::script('assets/js/plugins/datapicker/bootstrap-datepicker.js'); }}

<!-- iCheck -->
{{ HTML::script('assets/js/plugins/iCheck/icheck.min.js'); }}

<!-- Full Calendar -->
{{ HTML::script('assets/js/plugins/fullcalendar/fullcalendar.min.js'); }}

<!-- Steps -->
{{ HTML::script('assets/js/plugins/staps/jquery.steps.min.js'); }}

<!-- Jquery Validate -->
{{ HTML::script('assets/js/plugins/validate/jquery.validate.min.js'); }}

<!-- Jquery preimage -->
{{ HTML::script('assets/js/plugins/preimage/preimage.js'); }}

<!-- Jquery Fancybox -->
{{ HTML::script('assets/js/plugins/fancybox/jquery.fancybox.js'); }}
{{ HTML::script('assets/js/plugins/fancybox/jquery.fancybox.pack.js'); }}

<!-- Jquery Form -->
{{ HTML::script('assets/js/plugins/jQueryForm/jquery.form.js'); }}

<!-- Jquery UI -->
{{ HTML::script('assets/js/plugins/jquery-ui/jquery-ui.js'); }}

<!-- Datatable -->
{{ HTML::script('assets/js/plugins/dataTables/jquery.dataTables.js'); }}
{{ HTML::script('assets/js/plugins/dataTables/dataTables.bootstrap.js'); }}

<script>
	$(document).ready(function () {
		$.ajax({
			type: 'GET',
			url:'{{ URL::to('/returnLanguages/') }}',
			dataType:'json',
			success: function(response) {
				if (response.success == true) {
					$('#language').html('');
					$('#language').append('<option value=\"\">{{ Lang::get('menu.language') }}</option>');
					$.each(response.languages,function (k,v){
						$('#language').append('<option value=\"'+k+'\">'+v+'</option>');
					});
				}else{
					$('#language').html('');
					$('#language').append('<option value=\"\">{{ Lang::get('menu.language') }} </option>');
				}
			},
			error : function(jqXHR, status, error) {
				console.log('Disculpe, existió un problema');
			},
		});
		$('select#language').on('change',function(){
    		var valor = $(this).val();
    		$('#lang_id').val(valor);
		});
	});
</script>
@yield('scripts')


	
