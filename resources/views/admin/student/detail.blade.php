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
                                        <h3 class="card-title">{{ $detail->first_name }} {{ $detail->last_name }} Details</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ route('edit.admin.student',['id' => $detail->id]) }}"
                                           class="float-right btn btn-outline-primary" style="width:150px">
                                            Edit Student
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">

                                    <tr>
                                        <th>Image</th>
                                        <td>
                                            <img src="{{ asset($detail->image) }}" alt="" width="250px" height="250px" class="rounded-circle">
                                        </td>
                                    </tr>
                                       <tr>
                                           <th>First Name</th>
                                           <td>{{ $detail->first_name }}</td>
                                       </tr>
                                        <tr>
                                            <th>Last Name</th>
                                            <td>{{ $detail->last_name }}</td>
                                        </tr>
                                      <tr>
                                          <th>Semester Time</th>
                                          <td>
                                              {{ ($year->year == 1 ? 'One Year' : ($year->year == 3 ? 'Three Years' : ($year->year == 4 ? 'Four Years' : '' ))) }}
                                          </td>
                                      </tr>
                                            <tr>

                                                <th>Student ID</th>
                                                <td>{{ $detail->student_id }}</td>
                                            </tr>
                                        <tr>
                                            <tr>

                                                <th>Student Email</th>
                                                <td>{{ $detail->email }}</td>
                                            </tr>
                                        <tr>
                                            <th>Department</th>
                                            <td>{{ $year->class }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date</th>
                                            <td>{{ $detail->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <th>Father's Name</th>
                                            <td>{{ $detail->father_name }}</td>
                                        </tr>
                                       <tr>
                                           <th>Mother's Name</th>
                                           <td>{{ $detail->mother_name }}</td>
                                       </tr>
                                        <tr>
                                            <th>Blood</th>
                                            <td>{{ $detail->blood }}</td>
                                        </tr>
                                        <tr>
                                            <th>NID</th>
                                            <td>{{ $detail->nid }}</td>
                                        </tr>
                                        <tr>
                                            <th>Present Address</th>
                                            <td>
                                                <paragraph>{{ $detail->present_address }}</paragraph>
                                            </td>
                                        </tr>
                                    <tr>

                                        <th>Permanent Address</th>
                                        <td>
                                            <paragraph>{{ $detail->permanent_address }}</paragraph>

                                        </td>
                                    </tr>

                                       <tr>
                                           <th>Status</th>
                                           <td>
                                               @if($detail->status == 0)
                                                   <a href="{{ route('status.admin.student',['id'=> $detail->id]) }}" class="btn btn-sm btn-secondary">Inactive</a>
                                               @else
                                                   <a href="{{ route('status.admin.student',['id'=> $detail->id]) }}" class="btn btn-sm btn-primary" onclick="return confirm('Change to Inactive?')" >Active</a>
                                               @endif

                                           </td>
                                       </tr>

                                </table>



                            </div>
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





