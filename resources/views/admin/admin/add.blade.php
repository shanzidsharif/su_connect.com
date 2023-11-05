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
                                <h3 class="card-title">Add New Admin</h3>
                            </div>
                            <!-- /.card-header -->
                            <form action="{{ route('admin.add') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    @include('_message')
                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Name</label>
                                        <input type="text" name="name"  required class="col-md-9 form-control" placeholder="Name">
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Email</label>
                                        <input type="email" required name="email"  class="col-md-9 form-control" placeholder="Email">
                                        <div>
                                            {{ $errors->first('email') }}
                                        </div>
                                    </div>
                                    <div class="form-group row mt-2">
                                        <label for="" class="col-md-3">Password</label>
                                        <input type="password" required name="password" class="col-md-9 form-control" placeholder="Password">
                                    </div>

                                    <div class="mt-3 col-md-6 offset-3">
                                        <input type="submit" class="btn btn-outline-success form-control" value="Add Admin">
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
