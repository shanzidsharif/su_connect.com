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
                        @include('_message')
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3 class="card-title">{{ $edit->first_name }} {{ $edit->last_name }} Lecturer Edit Page</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <form action="{{ route('update.admin.lecturer') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $edit->id }}">
                                <div class="col-md-12 text-center" style="height: 300px;">
                                    <img src="{{ asset($edit->image) }}"  alt="" height="250px" width="250px" class="card-body rounded-circle">
                                    <input type="file" name="image" class="form-control">

                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">

                                        <tr>
                                            <th>First Name</th>
                                            <td>
                                                <input type="text" name="first_name" class="form-control" value="{{ $edit->first_name }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Last Name</th>
                                            <td>
                                                <input type="text" name="last_name" class="form-control" value="{{ $edit->last_name }}">                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Lecturer Email</th>
                                            <td>
                                                <input type="email" name="email" value="{{ old('email', $edit->email) }}"  required class="col-md-9 form-control" placeholder="Email">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Lecturer Password</th>
                                            <td>
                                                <input type="password" name="password" class="col-md-9 form-control" placeholder="Do you want to Change Password Then Type">
                                            </td>
                                        </tr>
                                        <tr>

                                            <th>Lecturer ID</th>
                                            <td>
                                                <input type="text" class="form-control" name="student_id" value="{{ $edit->lecturer_id }}">
                                            </td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Lecturer Mobile</th>
                                            <td>
                                                <input type="text" name="mobile" value="{{ $edit->mobile }}" required class="col-md-9 form-control" placeholder="Number">
                                            </td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Department</th>
                                            <td>
                                                <select name="department" class="form-control" id="" required>
                                                    @foreach($departments as $department)
                                                    <option class="form-control" value="{{ $department->id }}"{{ $department->id  == $edit->department ? 'selected' : '' }} >{{ $department->department }} {{ $department->year }}Y </option>
                                                    @endforeach

                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Joining Date</th>
                                            <td>

                                                <input type="date" name="joining_date"  value="{{ $edit->joining_date }}" class="col-md-9 form-control" placeholder="Birth Date">

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Date Of Birth</th>
                                            <td>
                                                <input type="date" name="date_of_birth" value="{{ $edit->date_of_birth }}" class="col-md-9 form-control" placeholder="Birth Date">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Experience</th>
                                            <td>
                                                <input type="text" name="experience" value="{{ $edit->experience }}"  class="col-md-9 form-control" placeholder="Work Experience in Years">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Qualification</th>
                                            <td>
                                                <input type="text" name="qualification" value="{{ $edit->qualification }}"  class="col-md-9 form-control" placeholder="Qualification">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Birth Date</th>
                                            <td>
                                                <input type="date" name="date_of_birth" class="form-control" value="{{ $edit->date_of_birth }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Admission Date</th>
                                            <td>
                                                <select name="gender" class="form-control" id="">
                                                        <option class="form-control" value="{{ $edit->gender }}"{{ $edit->gender  == 1 ? 'selected' : '' }} >Male</option>
                                                        <option class="form-control" value="{{ $edit->gender }}"{{ $edit->gender  == 2 ? 'selected' : '' }} >Female</option>
                                                        <option class="form-control" value="{{ $edit->gender }}"{{ $edit->gender  == 3 ? 'selected' : '' }} >Others</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>NID</th>
                                            <td>
                                                <input type="text" name="nid" class="form-control" value="{{ $edit->nid }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Present Address</th>
                                            <td>
                                                <textarea name="present_address" class="form-control" id="" cols="30" rows="10">{{ $edit->present_address }}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Permanent Address</th>
                                            <td>
                                                <textarea name="permanent_address" class="form-control" id="" cols="30" rows="10">{{ $edit->permanent_address }}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Bio</th>
                                            <td>
                                                <textarea name="bio" class="form-control" id="" cols="30" rows="10">{{ $edit->bio }}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                @if($edit->status == 0)
                                                    <a href="{{ route('status.admin.lecturer',['id'=> $edit->id]) }}" class="btn btn-sm btn-secondary">Inactive</a>
                                                @else
                                                    <a href="{{ route('status.admin.lecturer',['id'=> $edit->id]) }}" class="btn btn-sm btn-primary" onclick="return confirm('Change to Inactive?')" >Active</a>@endif

                                            </td>
                                        </tr>

                                        <tr class="mt-2">
                                            <th></th>
                                            <td>
                                                <input type="submit" class="widget-user btn btn-outline-success" value="Update Lecturer Details" >
                                            </td>
                                        </tr>

                                    </table>



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





