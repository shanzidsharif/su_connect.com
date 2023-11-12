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
                                        <h3 class="card-title">Subject List</h3>

                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="search" id="subjectSearch" placeholder="Search" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <a href="{{ route('add.subject') }}"
                                           class="float-right btn btn-success" style="width:150px">
                                            Add Subject
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
                                        <th>Subject Name</th>
                                        <th>Subject Code</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="subjectAllData">
                                    @foreach($list as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->code }}</td>
                                            <td>
                                                @if( $item->subject_type == 1) Theory
                                                @elseif( $item->subject_type == 2) LAB
                                                @endif

                                            </td>                                            <td>
                                                @if( $item->status == 1) Active
                                                @elseif( $item->status == 0) Inactive
                                                @endif

                                            </td>
                                            <td>
                                                <a href="{{ route('edit.subject',['id' => $item->id]) }}" class="btn btn-sm btn-success">Edit</a>
                                                <a href="{{ route('delete.subject',['id' => $item->id]) }}" class="btn btn-sm btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tbody id="subjectSearchData">

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

        $('#subjectSearch').on('keyup', function () {
            var value = $(this).val();
            if(value)
            {
                $('#subjectAllData').hide();
                $('#subjectSearchData').show();
            }
            else{
                $('#subjectAllData').show();
                $('#subjectSearchData').hide();
            }
            $.ajax({
                type:"GET",
                url: "{{ route('search.subject') }}",
                data: {'search': value},
                success:function (data) {
                    console.log(data);
                    $('#subjectSearchData').html(data);
                },
                // error:function(jqXHR){alert(jqXHR.status);},

            });
        });

    </script>

@endsection





