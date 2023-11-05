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
                                        <h3 class="card-title">Admin List Table</h3>

                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="search" id="search" placeholder="Search" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <a href="{{ route('add') }}"
                                           class="float-right btn btn-success" style="width:150px">
                                            Add Admin
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tableAllData">
                                    @foreach($list as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <a href="{{ route('edit.admin',['id' => $item->id]) }}" class="btn btn-sm btn-success">Edit</a>
                                            <a href="{{ route('delete.admin',['id' => $item->id]) }}" class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                    <tbody id="tableSearchData">

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

        $('#search').on('keyup', function () {
            var value = $(this).val();
            if(value)
            {
                $('#tableAllData').hide();
                $('#tableSearchData').show();
            }
            else{
                $('#tableAllData').show();
                $('#tableSearchData').hide();
            }
            $.ajax({
                type:"GET",
                url: "{{ route('search') }}",
                data: {'search': value},
                success:function (data) {
                    console.log(data);
                    $('#tableSearchData').html(data);
                },
                // error:function(jqXHR){alert(jqXHR.status);},


            });
        });

    </script>

@endsection





