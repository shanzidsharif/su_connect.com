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
                                <h3 class="card-title">Add New Subject</h3>
                            </div>
                            <!-- /.card-header -->
                            <form action="{{ route('insert.subject') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    @include('_message')
                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Subject Name</label>
                                        <input type="text" name="name"  required class="col-md-9 form-control" placeholder="Subject Name">
                                        <div>
                                            {{ $errors->first('name') }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Subject Code</label>
                                        <input type="text" name="code"  required class="col-md-9 form-control" placeholder="Subject Code">
                                        <div>
                                            {{ $errors->first('code') }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Type</label>
                                        <select name="subject_type" class="col-md-9 form-control" id="">
                                            <option value="" selected disabled>--Select Subject Type--</option>
                                            <option value="1">Theory</option>
                                            <option value="2">LAB</option>
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
