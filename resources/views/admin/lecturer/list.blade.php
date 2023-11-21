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
                                        <h3 class="card-title">Lecturer List</h3>

                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="search" id="adminLecturerSearch" placeholder="Search" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <a href="{{ route('add.admin.lecturer') }}"
                                           class="float-right btn btn-success" style="width:150px">
                                            Add Lecturer
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Joining Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="adminLecturerAllData">
                                    @foreach($list as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset($item->image) }}" alt="" height="30px"  class="rounded-circle widget-user">
                                            </td>
                                            <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->mobile }}</td>
                                            <td>
                                                {{ $item->joining_date }}
                                            </td>
                                            <td>
                                                @if($item->status == 0)
                                                    <a href="{{ route('status.admin.lecturer',['id'=> $item->id]) }}" class="btn btn-sm btn-secondary">Inactive</a>
                                                @else
                                                    <a href="{{ route('status.admin.lecturer',['id'=> $item->id]) }}" class="btn btn-sm btn-primary" onclick="return confirm('Change to Inactive?')" >Active</a>
                                                @endif

                                            </td>
                                            <td>
                                                <a href="{{ route('details.admin.lecturer',['id' => $item->id]) }}" class="btn btn-sm btn-info">Details</a>
                                                <a href="{{ route('edit.admin.lecturer',['id' => $item->id]) }}" class="btn btn-sm btn-success">Edit</a>
                                                <a href="{{ route('delete.admin.lecturer',['id' => $item->id]) }}" class="btn btn-sm btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tbody id="adminLecturerSearchData">

                                    </tbody>
                                </table>
                                {!! $list->links() !!}
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
    <script type="text/javascript">

        $('#adminLecturerSearch').on('keyup', function () {
            var value = $(this).val();
            if(value)
            {
                $('#adminLecturerAllData').hide();
                $('#adminLecturerSearchData').show();
            }
            else{
                $('#adminLecturerAllData').show();
                $('#adminLecturerSearchData').hide();
            }
            $.ajax({
                type:"GET",
                url: "{{ route('search.admin.lecturer') }}",
                data: {'search': value},
                success:function (data) {
                    console.log(data);
                    $('#adminLecturerSearchData').html(data);
                },
                 // error:function(jqXHR){alert(jqXHR.status);},


            });
        });

    </script>

@endsection





