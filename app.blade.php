<!DOCTYPE html>
<html lang="en">
<head>
    @section('head')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@section('title') {{ config('app.name', 'Laravel') }} @show</title>


    <!-- Workaround for FA-CORS restrictions!-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js" type="text/javascript"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js" type="text/javascript"></script>
    <![endif]-->




    <script type="text/javascript">
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <!-- App styles !-->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- App scripts -->
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/vendor/jquery/are-you-sure/are-you-sure.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/vendor/bootbox/bootbox.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            //Close alerts automatically
            $(".alert-autoclose").fadeTo(2000, 500).fadeOut(10000, function(){
                $(".alert-info").alert('close');
            });

            //Are you sure forms
            $('form.are-you-sure').areYouSure({'addRemoveFieldsMarksDirty':true});
        });
    </script>
@show
</head>
<body>
@include('partials.nav')

<div class="container-fluid">
    <div class="col-md-10 col-md-offset-1">
        <div class="row">
            <div class="page-header">
                <h2>@section('page_header')@show</h2>
            </div>
        </div>
        <div class="row">
            @if (Session::has('message'))
                <div class="alert alert-info alert-dismissible alert-autoclose" role="alert">
                    {!! Form::button('<span aria-hidden="true">&times;</span>', ['class' => 'close', 'data-dismiss' => 'alert', 'aria-label' => 'Close']) !!}
                    {!! Session::get('message') !!}
                </div>
            @endif

            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible alert-autoclose" role="alert">
                    {!! Form::button('<span aria-hidden="true">&times;</span>', ['class' => 'close', 'data-dismiss' => 'alert', 'aria-label' => 'Close']) !!}
                    {!! Session::get('error') !!}
                </div>
            @endif
        </div>
        @yield('content')
    </div>
</div>

<!-- HIDDEN_START !-->
<div class="modal" id="pleaseWaitDialog" tabindex="-1" role="dialog" aria-labelledby="pleaseWaitDialogLabel"  data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="pleaseWaitDialogLabel">Please wait</h4>
            </div>
            <div class="modal-body">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100"
                         aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- HIDDEN_END !-->
</body>
</html>