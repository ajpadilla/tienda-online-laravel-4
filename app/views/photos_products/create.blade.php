@extends('layouts.template')

@section('title')
{{--{{ trans('classifieds.labels.name')}}--}}
{{	trans('photoProduct.title') }}
@stop


@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h1 class="pagetitle nodesc">
					{{	trans('photoProduct.subtitle') }} {{ $productLanguage->pivot->name }}
				</h1>
			</div>
			<div class="ibox-content">
				<div class="row">
					<section id="content" class=" col-lg-offset-2 col-lg-10">
						<div id="actions" class="row">
							<div class="col-lg-7">
								<!-- The fileinput-button span is used to style the file input field as button -->
								<button id="addPhoto" class="btn btn-success fileinput-button dz-clickable">
									<i class="glyphicon glyphicon-plus"></i>
									<span>{{ trans('photoProduct.labels.add') }}</span>
								</button>
								<button type="submit" class="btn btn-primary start">
									<i class="glyphicon glyphicon-upload"></i>
									<span>{{ trans('photoProduct.labels.init') }}</span>
								</button>
								<button type="reset" class="btn btn-warning cancel">
									<i class="glyphicon glyphicon-ban-circle"></i>
									<span>{{ trans('photoProduct.labels.cancel') }}</span>
								</button>
									{{--{{ Form::open(['route' => 'products.index', 'method' => 'get']) }}
										<button type="submit" href="{{ route('products.index') }}" class="btn-alert">
											<span>Lista de Productos</span>
										</button>
										{{ Form::close() }}--}}
									</div>
									<div class="col-lg-5">
										<!-- The global file processing state -->
										<span class="fileupload-process">
											<div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
												<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress=""></div>
											</div>
										</span>
									</div>
								</div>
								<section id="previews" class="row" class="files">
									<div id="template" class="row">
										<!-- This is used as the file preview template -->
										<div class="col-lg-1">
											<span class="preview"><img data-dz-thumbnail /></span>
										</div>
										<div class="col-lg-4">
											<p class="name" data-dz-name></p>
											<strong class="error text-danger" data-dz-errormessage></strong>
										</div>
										<div class="col-lg-2">
											<p class="size" data-dz-size></p>
											<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
												<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
											</div>
										</div>
										<div class="col-lg-5">
											<button class="btn btn-primary start">
												<i class="glyphicon glyphicon-upload"></i>
												<span>{{ trans('photoProduct.labels.init') }}</span>
											</button>
											<button data-dz-remove class="btn btn-warning cancel">
												<i class="glyphicon glyphicon-ban-circle"></i>
												<span>{{ trans('photoProduct.labels.cancel') }}</span>
											</button>
											<button data-dz-remove class="btn btn-danger delete">
												<i class="glyphicon glyphicon-trash"></i>
												<span>{{ trans('photoProduct.labels.delete') }}</span>
											</button>
										</div>
									</div>
								</section>
							</section><!-- content -->
						</section>
					</div>
				</div>
			</div>
		</div>
@stop

@section('scripts')
	<script>
		var previewNode = document.querySelector("#template");
		previewNode.id = "";
		var previewTemplate = previewNode.parentNode.innerHTML;
		previewNode.parentNode.removeChild(previewNode);

		var myDropzone = new Dropzone(document.body, {
			url: "{{ route('photoProduct.store') }}",
			thumbnailWidth: 80,
            thumbnailHeight: 80,
			addRemoveLinks: true,
			maxFilesize: 2,
			acceptedFiles: "image/*",
			previewTemplate: previewTemplate,
			autoQueue: false,
			previewsContainer: "#previews",
			clickable: '.fileinput-button'
        });

		myDropzone.on("addedfile", function(file) {
		  // Hookup the start button
		  file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
		});

		// Update the total progress bar
		myDropzone.on("totaluploadprogress", function(progress) {
		  document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
		});

		myDropzone.on("sending", function(file, xhr, formData) {
			formData.append('product_id', '{{ $productoId }}');
		  // Show the total progress bar when upload starts
		  document.querySelector("#total-progress").style.opacity = "1";
		  // And disable the start button
		  file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
		});

		// Hide the total progress bar when nothing's uploading anymore
		myDropzone.on("queuecomplete", function(progress) {
		  document.querySelector("#total-progress").style.opacity = "0";
		});

		// Setup the buttons for all transfers
		// The "add files" button doesn't need to be setup because the config
		// `clickable` has already been specified.
		document.querySelector("#actions .start").onclick = function() {
		  myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
		};
		document.querySelector("#actions .cancel").onclick = function() {
		  myDropzone.removeAllFiles(true);
		};
	</script>
@stop