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
                                <h3 class="card-title">Edit Subject</h3>
                            </div>
                            <!-- /.card-header -->
                            <form action="{{ route('update.subject') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{  $list->id }}" name="id">
                                <div class="card-body">
                                    @include('_message')
                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Subject Name</label>
                                        <input type="text" name="name" class="col-md-9 form-control" required value="{{ old('name',$list->name) }}">
                                        <div class="text-danger">
                                            {{ $errors->first('name') }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Subject Code</label>
                                        <input type="text" name="code" class="col-md-9 form-control" required value="{{ old('code',$list->code) }}">
                                        <div class="text-danger">
                                            {{ $errors->first('code') }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Type</label>
                                        <select name="subject_type" class="col-md-9 form-control" id="">
                                            <option value=""  disabled>--Select Subject Type--</option>
                                            <option {{ $list->subject_type == 1 ? 'selected' : '' }} value="1">Theory</option>
                                            <option {{ $list->subject_type == 2 ? 'selected' : '' }} value="2">Lab</option>
                                        </select>

                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Status</label>
                                        <select name="status" class="col-md-9 form-control" id="">
                                            <option value=""  disabled>--Select Status--</option>
                                            <option {{ $list->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                            <option {{ $list->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                                        </select>

                                    </div>


                                    <div class="mt-3 col-md-6 offset-3">
                                        <input type="submit" class="btn btn-outline-success form-control" value="Update Subject">
                                    </div>
                                </div>
                            </form>
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


