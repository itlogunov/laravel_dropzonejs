<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Laravel Upload Image Using DropzoneJs</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
</head>
<body>
<div class="container">
    <h2>Laravel Upload Image Using DropzoneJs</h2><br/>
    <form method="post" action="{{ route('dropzone.store') }}" enctype="multipart/form-data" class="dropzone"
          id="dropzone">
        @csrf
    </form>
</div>
<script type="text/javascript">
    Dropzone.options.dropzone =
        {
            maxFilesize: 10,
            // renameFile: function (file) {
            //     return 'str' + file.name;
            // },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            removedfile: function (file) {
                let name = file.name;
                name = name.replace(/ /g, '-').toLowerCase();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: 'destroy',
                    data: {
                        'id': name
                    },
                    success: function (data) {
                        console.log(data);
                    }
                });
                var _ref;

                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            },
            timeout: 60000,
            success: function (file, response) {
                console.log(response);
            },
            error: function (file, response) {
                return false;
            }
        };
</script>
</body>
</html>
