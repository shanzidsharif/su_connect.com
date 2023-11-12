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
                                        <h3 class="card-title">Class List</h3>

                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="search" id="classSearch" placeholder="Search" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <a href="{{ route('add.class') }}"
                                           class="float-right btn btn-success" style="width:150px">
                                            Add Class
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
                                        <th>Department Name</th>
                                        <th>Semester Time</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="classAllData">
                                    @foreach($list as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->department }}</td>
                                            <td>
                                                {{ ($item->year == 1 ? 'One Year' : ($item->year == 3 ? 'Three Years' : ($item->year == 4 ? 'Four Years' : '' ))) }}


                                            </td>
                                            <td>{{ $item->created_at }}
                                            <td>
                                                @if($item->status == 0)
                                                    <a href="{{ route('status.class',['id'=> $item->id]) }}" class="btn btn-sm btn-secondary">Inactive</a>
                                                @else
                                                    <a href="{{ route('status.class',['id'=> $item->id]) }}" class="btn btn-sm btn-primary" onclick="return confirm('Change to Inactive?')" >Active</a>
                                                @endif

                                            </td>
                                            <td>
                                                <a href="{{ route('edit.class',['id' => $item->id]) }}" class="btn btn-sm btn-success">Edit</a>
                                                <a href="{{ route('delete.class',['id' => $item->id]) }}" class="btn btn-sm btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tbody id="classSearchData">

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

        $('#classSearch').on('keyup', function () {
            var value = $(this).val();
            if(value)
            {
                $('#classAllData').hide();
                $('#classSearchData').show();
            }
            else{
                $('#classAllData').show();
                $('#classSearchData').hide();
            }
            $.ajax({
                type:"GET",
                url: "{{ route('search.class') }}",
                data: {'search': value},
                success:function (data) {
                    console.log(data);
                    $('#classSearchData').html(data);
                },
                // error:function(jqXHR){alert(jqXHR.status);},


            });
        });

    </script>

@endsection





