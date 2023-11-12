@extends('master')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add New Department</h3>
                            </div>
                            <!-- /.card-header -->
                            <form action="{{ route('insert.class') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    @include('_message')
                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Department Name</label>
                                        <input type="text" name="department"  required class="col-md-9 form-control" placeholder="Department">
                                        <div>
                                            {{ $errors->first('department') }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Year</label>
                                        <select name="year" class="col-md-9 form-control" id="">
                                            <option value="" selected disabled>--Select Year--</option>
                                            <option value="1">One</option>
                                            <option value="3">Three</option>
                                            <option value="4">Four</option>
                                        </select>

                                    </div>

                                    <div class="mt-3 col-md-6 offset-3">
                                        <input type="submit" class="btn btn-outline-success form-control" value="Create New Department">
                                    </div>
                                </div>
                            </form
                                <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
