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
                                <h3 class="card-title">Add New Lecturer</h3>
                            </div>
                            <!-- /.card-header -->
                            <form action="{{ route('insert.admin.lecturer') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    @include('_message')

                                    <div class="form-group row">
                                        <label for="" class="col-md-3">First Name<span class="text-danger">*</span></label>
                                        <input type="text" name="first_name"  required class="col-md-9 form-control" placeholder="First Name">
                                        <div>
                                            {{ $errors->first('first_name') }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Last Name<span class="text-danger">*</span></label>
                                        <input type="text" name="last_name"  required class="col-md-9 form-control" placeholder="Last Name">
                                        <div>
                                            {{ $errors->first('last_name') }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Email<span class="text-danger">*</span></label>
                                        <input type="email" name="email"  required class="col-md-9 form-control" placeholder="Email">
                                        <div>
                                            {{ $errors->first('email') }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Mobile<span class="text-danger">*</span></label>
                                        <input type="text" name="mobile"  required class="col-md-9 form-control" placeholder="Number">
                                        <div>
                                            {{ $errors->first('mobile') }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Lecturer ID<span class="text-danger">*</span></label>
                                        <input type="text" name="lecturer_id" required class="col-md-9 form-control" placeholder="Lecturer ID">
                                        <div>
                                            {{ $errors->first('lecturer_id') }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Department<span class="text-danger">*</span></label>
                                        <select name="department" class="col-md-9 form-control" id="">
                                            <option value="" selected disabled>--Select Department--</option>
                                            @foreach( $departments as $item)
                                                <option value="{{ $item->id }}">{{ $item->department }}  {{ $item->year }}Y</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Birth Date</label>
                                        <input type="date" name="date_of_birth" class="col-md-9 form-control" placeholder="Birth Date">
                                        <div>
                                            {{ $errors->first('date_of_birth') }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Joining Date</label>
                                        <input type="date" name="joining_date" class="col-md-9 form-control" placeholder="Joining Date">
                                        <div>
                                            {{ $errors->first('admission_date') }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Gender</label>
                                        <select name="gender" class="col-md-9 form-control" id="">
                                            <option value="" selected disabled>--Select Gender--</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                            <option value="3">Others</option>
                                        </select>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Qualification</label>
                                        <input type="text" name="qualification"   class="col-md-9 form-control" placeholder="Qualification">
                                        <div>
                                            {{ $errors->first('qualification') }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Work Experience</label>
                                        <input type="text" name="experience"   class="col-md-9 form-control" placeholder="Work Experience in Years">
                                        <div>
                                            {{ $errors->first('mother_name') }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-3">National ID</label>
                                        <input type="text" name="nid"   class="col-md-9 form-control" placeholder="NID">
                                        <div>
                                            {{ $errors->first('nid') }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Present Address</label>
                                        <textarea name="present_address" class="form-control col-md-9" id="" cols="30" rows="10"></textarea>
                                        <div>
                                            {{ $errors->first('present_address') }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Permanent Address</label>
                                        <textarea name="permanent_address" class="form-control col-md-9" id="" cols="30" rows="10"></textarea>
                                        <div>
                                            {{ $errors->first('permanent_address') }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Bio</label>
                                        <textarea name="bio" class="form-control col-md-9" id="" cols="30" rows="10"></textarea>
                                        <div>
                                            {{ $errors->first('bio') }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Profile Image</label>
                                        <input type="file" name="image" class="form-control col-md-9" accept="image/*">
                                        <div>
                                            {{ $errors->first('image') }}
                                        </div>
                                    </div>

                                    <div class="mt-3 col-md-6 offset-3">
                                        <input type="submit" class="btn btn-outline-success form-control" value="Create New Lecturer">
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
