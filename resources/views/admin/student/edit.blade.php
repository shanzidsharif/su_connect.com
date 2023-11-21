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
                                        <h3 class="card-title">{{ $edit->first_name }} {{ $edit->last_name }} Student Edit Page</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <form action="{{ route('update.admin.student') }}" method="POST" enctype="multipart/form-data">
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
                                            <th>Semester Time</th>
                                            <td>
                                                {{ ($year->year == 1 ? 'One Year' : ($year->year == 3 ? 'Three Years' : ($year->year == 4 ? 'Four Years' : '' ))) }}
                                            </td>
                                        </tr>
                                        <tr>

                                            <th>Student ID</th>
                                            <td>
                                                <input type="text" class="form-control" name="student_id" value="{{ $edit->student_id }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Student Email</th>
                                            <td>
                                                <input type="email" class="form-control" name="email" value="{{ $edit->email }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Student Password</th>
                                            <td>
                                                <span>If you want to change Default Password then Enter</span>
                                                <input type="password" class="form-control" name="password" placeholder="If you want to change Password">
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
                                            <th>Date</th>
                                            <td>{{ $edit->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <th>Father's Name</th>
                                            <td>
                                                <input type="text" name="father_name" class="form-control" value="{{ $edit->father_name }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Mother's Name</th>
                                            <td>
                                                <input type="text" name="mother_name" class="form-control" value="{{ $edit->mother_name }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Blood</th>
                                            <td>
                                                <input type="text" name="blood" class="form-control" value="{{ $edit->blood }}">
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
                                                <input type="date" name="admission_date" class="form-control" value="{{ $edit->admission_date }}">
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
                                            <th>Status</th>
                                            <td>
                                                @if($edit->status == 0)
                                                    <a href="{{ route('status.admin.student',['id'=> $edit->id]) }}" class="btn btn-sm btn-secondary">Inactive</a>
                                                @else
                                                    <a href="{{ route('status.admin.student',['id'=> $edit->id]) }}" class="btn btn-sm btn-primary" onclick="return confirm('Change to Inactive?')" >Active</a>
                                                @endif

                                            </td>
                                        </tr>

                                        <tr class="mt-2">
                                            <th></th>
                                            <td>
                                                <input type="submit" class="widget-user btn btn-outline-success" value="Update Student Details" >
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





