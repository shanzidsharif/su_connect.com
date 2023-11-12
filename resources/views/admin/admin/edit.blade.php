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
                                <h3 class="card-title">Edit Admin</h3>
                            </div>
                            <!-- /.card-header -->
                            <form action="{{ route('update.admin',['id' => $user->id]) }}" method="post">
                                @csrf
                                <div class="card-body">
                                    @include('_message')
                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Name</label>
                                        <input type="text" name="name" class="col-md-9 form-control" required value="{{ old('name',$user->name) }}">
                                        <div class="text-danger">
                                            {{ $errors->first('name') }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Email</label>
                                        <div class="col-md-9">
                                            <input type="email" name="email" required class="form-control" value="{{ old('email',$user->email) }}">
                                            <p class="text-danger">{{ $errors->first('email') }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-2">
                                        <label for="" class="col-md-3">Password</label>
                                        <div class="col-md-9">
                                            <input type="password" name="password" class="form-control" placeholder="">
                                            <span class="text-info">If you want to change password then Type in Password Field</span>
                                        </div>

                                    </div>

                                    <div class="mt-3 col-md-6 offset-3">
                                        <input type="submit" class="btn btn-outline-success form-control" value="Update">
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
