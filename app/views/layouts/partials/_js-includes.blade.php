<!-- Mainly scripts -->
{{ HTML::script('assets/js/jquery-1.10.2.js'); }}
{{ HTML::script('assets/js/mustache.min.js'); }}
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

<!-- Jquery Form -->
{{ HTML::script('assets/js/plugins/jQueryForm/jquery.form.min.js'); }}

<!-- Chosen -->
{{ HTML::script('assets/js/plugins/chosen/chosen.jquery.js')}}

<!-- Jquery Fancybox -->
{{ HTML::script('assets/js/plugins/fancybox/jquery.fancybox.js'); }}
{{ HTML::script('assets/js/plugins/fancybox/jquery.fancybox.pack.js'); }}

<!-- summernote -->
{{ HTML::script('assets/js/plugins/summernote/summernote.min.js'); }}

<!-- Jquery UI -->
{{ HTML::script('assets/js/plugins/jquery-ui/jquery-ui.js'); }}

<!-- Datatable -->
{{ HTML::script('assets/js/plugins/dataTables/jquery.dataTables.js'); }}
{{ HTML::script('assets/js/plugins/dataTables/dataTables.bootstrap.js'); }}

<!-- simplecolorpicker -->
{{ HTML::script('assets/js/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js'); }}

{{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-hover-dropdown/2.0.10/bootstrap-hover-dropdown.js') }}

{{ HTML::script('assets/js/plugins/rateit/jquery.rateit.min.js') }}
{{ HTML::script('assets/js/plugins/zoom/jquery.zoom.min.js') }}
{{ HTML::script('assets/js/plugins/uniform/jquery.uniform.min.js') }}
{{ HTML::script('assets/js/plugins/bootstrap-touchspin/bootstrap.touchspin.js') }}

<!-- BOOTBOX -->
{{ HTML::script('assets/js/plugins/bootbox/bootbox.min.js') }}

<!-- product zoom -->
{{ HTML::script('assets/js/custom.js') }}

<script>
	jQuery(".btn.btn-info.btn-circle").fancybox({
		centerOnScroll: true,
		hideOnOverlayClick: true,
		type:'iframe',
		autoScale: true,
		width : '100%',
		height : '70%'
	});

	jQuery(".btn.btn-warning.btn-circle").fancybox({
		centerOnScroll: true,
		hideOnOverlayClick: true,
		type:'iframe',
		autoScale: true,
		width : '100%',
		height : '70%'
	});

	$('.tooltip-pop').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    });

	var handleMenu = function() {
        $(".header .navbar-toggle").click(function () {
            if ($(".header .navbar-collapse").hasClass("open")) {
                $(".header .navbar-collapse").slideDown(300)
                .removeClass("open");
            } else {
                $(".header .navbar-collapse").slideDown(300)
                .addClass("open");
            }
        });
    }
    var handleSubMenuExt = function() {
        $(".header-navigation.dropdown").on("hover", function() {
            alert('menu');
            if ($(this).children(".header-navigation-content-ext").show()) {
                if ($(".header-navigation-content-ext").height()>=$(".header-navigation-description").height()) {
                    $(".header-navigation-description").css("height", $(".header-navigation-content-ext").height()+22);
                }
            }
        });
    }

    var handleSidebarMenu = function () {
        $(".sidebar .dropdown a i").click(function (event) {
            event.preventDefault();
            if ($(this).parent("a").hasClass("collapsed") == false) {
                $(this).parent("a").addClass("collapsed");
                $(this).parent("a").siblings(".dropdown-menu").slideDown(300);
            } else {
                $(this).parent("a").removeClass("collapsed");
                $(this).parent("a").siblings(".dropdown-menu").slideUp(300);
            }
        });
    }

    var getAttributeIdActionSelect = function (id) {
        var action = new Object(); 
        action.typeAction = id ? id.split('_')[0] : '';
        action.view = id ? id.split('_')[1] : '';
        action.number = id ? id.split('_')[2] : '';
        return action;
    }

    var showPopUpFancybox = function (selector) {
        $.fancybox($(selector),{
            openEffect  : 'elastic',
            closeEffect : 'elastic',
            centerOnScroll: true,
            hideOnOverlayClick: true,
            width : '70%',
            height : '70%'
        });
    }

    var reloadDataTable = function (table) {
        var table = typeof table !== 'undefined' ? table : 'datatable';
        if($(table).length) {
            var table = $(table).DataTable();
            table.search('').draw();
        }
    }

    function fancyConfirm(msg, functionDelete, elementId)
    {
        jQuery.fancybox({
            'modal' : true,
            'content' : "<div style=\"margin:1px;width:240px;\">"+msg+"<div style=\"text-align:right;margin-top:10px;\"><input id=\"fancyconfirm_cancel\" style=\"margin:3px;padding:0px;\" type=\"button\" value=\"Cancel\"><input id=\"fancyConfirm_ok\" style=\"margin:3px;padding:0px;\" type=\"button\" value=\"Ok\"></div></div>",
            'beforeShow' : function() {
                jQuery("#fancyconfirm_cancel").click(function() {
                    $.fancybox.close();
                });

                jQuery("#fancyConfirm_ok").click(function() {
                    $.fancybox.close();
                    functionDelete(elementId);
                });
            }
        });
    }

</script>

@yield('in-situ-js')
@yield('table')
@yield('scripts')
