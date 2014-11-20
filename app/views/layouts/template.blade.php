<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    @include('layouts.partials._css-includes')

</head>

<body>

    <div id="wrapper">

        @include('layouts.partials._nav-sidebar')

        <div id="page-wrapper" class="gray-bg">
            @include('layouts.partials._nav-topbar')
            @include('layouts.partials._page-heading')
			@include('layouts.partials._page-content-blank')
            <!--Fin Contenido-->
        </div>
        <!-- Inicio Page Wrapper -->
    </div>
    <!-- Fin Wrapper -->
    @include('layouts.partials._js-includes')
</body>

</html>
