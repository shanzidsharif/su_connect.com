@extends('master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <input type="text" id="search" class="form-control">
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $('#search').on('keyup', function () {
            // console.log('hi');
            alert('hi');
        })

    </script>
    @endsection
