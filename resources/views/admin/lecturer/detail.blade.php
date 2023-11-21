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
                                        <a href="{{ route('edit.admin.lecturer',['id' => $detail->id]) }}"
                                           class="float-right btn btn-outline-primary" style="width:150px">
                                            Edit Lecturer
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
                                          <th>Email</th>
                                          <td>
                                              {{ $detail->email }}
                                          </td>
                                      </tr>
                                            <tr>

                                                <th>Lecturer ID</th>
                                                <td>{{ $detail->lecturer_id }}</td>
                                            </tr>
                                        <tr>
                                            <tr>

                                                <th>Qualification</th>
                                                    <td>{{ $detail->qualification }}</td>
                                            </tr>
                                        <tr>
                                            <th>Department</th>
                                            <td>{{ $year->class }}</td>
                                        </tr>
                                        <tr>
                                            <th>Joining Date</th>
                                            <td>{{ $detail->joining_date }}</td>
                                        </tr>
                                        <tr>
                                            <th>BirthDate</th>
                                            <td>{{ $detail->date_of_birth }}</td>
                                        </tr>
                                       <tr>
                                           <th>Maritial Status</th>
                                           <td>{{ $detail->maritial_status }}</td>
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
                                        <th>Bio</th>
                                        <td>
                                            <paragraph>{{ $detail->bio }}</paragraph>

                                        </td>
                                    </tr>

                                       <tr>
                                           <th>Status</th>
                                           <td>
                                               @if($detail->status == 0)
                                                   <a href="{{ route('status.admin.lecutrer',['id'=> $detail->id]) }}" class="btn btn-sm btn-secondary">Inactive</a>
                                               @else
                                                   <a href="{{ route('status.admin.lecturer',['id'=> $detail->id]) }}" class="btn btn-sm btn-primary" onclick="return confirm('Change to Inactive?')" >Active</a>
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





