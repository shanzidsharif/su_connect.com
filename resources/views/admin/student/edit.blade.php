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
                                <h3 class="card-title">Edit Department</h3>
                            </div>
                            <!-- /.card-header -->
                            <form action="{{ route('update.class') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{  $list->id }}" name="id">
                                <div class="card-body">
                                    @include('_message')
                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Department Name</label>
                                        <input type="text" name="department" class="col-md-9 form-control" required value="{{ old('department',$list->department) }}">
                                        <div class="text-danger">
                                            {{ $errors->first('department') }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Year</label>
                                        <select name="year" class="col-md-9 form-control" id="">
                                            <option value=""  disabled>--Select Year--</option>
                                            <option {{ $list->year == 1 ? 'selected' : '' }}value="1">One</option>
                                            <option {{ $list->year == 3 ? 'selected' : '' }} value="3">Three</option>
                                            <option {{ $list->year == 4 ? 'selected' : '' }} value="4">Four</option>
                                        </select>
                                    </div>
                                    <div class="mt-3 col-md-6 offset-3">
                                        <input type="submit" class="btn btn-outline-success form-control" value="Update Department">
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
