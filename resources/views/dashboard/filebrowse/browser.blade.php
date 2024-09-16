<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Images</title> 
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('dashboard/js/jquery.min.js')}}"></script>
    <script src="{{asset('dashboard/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Styles -->
    <link href="{{asset('dashboard/css/bootstrap.min.css')}}" rel="stylesheet">
    <script type='text/javascript'>
        $(function () {
            $('body').on('click', 'img', function () {
                window.opener.CKEDITOR.tools.callFunction({{ $CKEditorFuncNum }}, $(this).attr('src'), '');
                window.close();
                });
            });
    </script>
</head>

<body>
    <div class="container">
        <div class="row">
            @foreach($files as $file)
            <div class="col-4 py-3">
                <img src="{{ asset($file) }}" alt="..." class="img-fluid" style=" cursor: pointer;">
            </div>
            @endforeach
        </div>
    </div>
</body>

</html>
