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
                                        <h3 class="card-title">Subject and Class List</h3>

                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="search" id="classSubjectSearch" placeholder="Search" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <a href="{{ route('add.subject.class') }}"
                                           class="float-right btn btn-success" style="width:150px">
                                            Assign Subject
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
                                        <th>Class Name</th>
                                        <th>Year</th>
                                        <th>Semester</th>
                                        <th>Subject Name</th>
                                        <th>Assigned By</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="classSubjectAllData">
                                    @foreach($list as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->class_name }}</td>
                                            <td>{{ $item->year }}</td>
                                            <td>{{ $item->semester }}</td>
                                            <td>{{ $item->subject_name }}</td>
                                            <td>{{ $item->assigned_by }}</td>
                                            <td>
                                                @if( $item->status == 1)
                                                    <a href="{{ route('status.subject.class',['id' => $item->id]) }}" class="btn btn-primary btn-sm">Active</a>
                                                @elseif( $item->status == 0)
                                                    <a href="{{ route('status.subject.class',['id' => $item->id]) }}" class="btn btn-secondary btn-sm">Inactive</a>
                                                @endif

                                            </td>
                                            <td>
                                                <a href="{{ route('edit.subject.class',['id' => $item->id]) }}" class="btn btn-sm btn-success">Edit</a>
                                                <a href="{{ route('delete.subject.class',['id' => $item->id]) }}" class="btn btn-sm btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tbody id="classSubjectSearchData">

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

        $('#classSubjectSearch').on('keyup', function () {
            var value = $(this).val();
            if(value)
            {
                $('#classSubjectAllData').hide();
                $('#classSubjectSearchData').show();
            }
            else{
                $('#classSubjectAllData').show();
                $('#classSubjectSearchData').hide();
            }
            $.ajax({
                type:"GET",
                url: "{{ route('search.subject.class') }}",
                data: {'search': value},
                success:function (data) {
                    console.log(data);
                    $('#classSubjectSearchData').html(data);
                },
                 error:function(jqXHR){alert(jqXHR.status);},

            });
        });

    </script>

@endsection





