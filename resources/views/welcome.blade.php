<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>


    <div class="container mt-5">
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <label for="select-region">Select Region</label>
                        <select class="form-control" id="select-region">
                            @foreach ($regions as $region)
                            <option value="{{ $region['name'] }}" data-id="{{ $region['id'] }}">
                                {{ $region['name'] }}</option>
                            @endforeach
                        </select>
                        <label for="select-township" class="mt-3">Select Township</label>
                        <select class="form-control" id="select-township">
                            <option selected>Please select region first</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function(){
            $('#select-region').on('change',function(){
                var region_id = $('option:selected', this).attr('data-id');
                $.ajax({
                    url : 'http://myancity.devsm.net/api/region/' + region_id,
                    data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: 'get',
                    dataType: 'json',
                    success: function( result )
                    {
                        $('#select-township').empty();
                        $.each( result, function(k, v) {
                            $('#select-township').append($('<option>', {value:v.name, text:v.name}));
                        });
                    },
                    error: function()
                {
                    //handle errors
                    alert('Township API Errors!!!');
                }
                });
            });

        })
    </script>


</body>

</html>
