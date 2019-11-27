@extends('admin.master')
@section('title')
    Delivery Man
@endsection
@section('content')

    <div class="col-sm-offset-2 col-sm-10" style="padding-left: 2%">

    <hr>
        <div class="tab-content">
            <div class="tab-pane active" id="home">

                <!-- /.row -->

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                DataTables Advanced Tables
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>SL NO</th>
                                        <th>Customer ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Access</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1; ?>
                                    @foreach($customers as $customer)
                                        <tr class="odd gradeX">
                                            <td>{{ $i++ }}</td>
                                            <td>{{$customer->id}}</td>
                                            <td>{{$customer->name}}</td>
                                            <td>{{$customer->email}}</td>
                                            <td>{{$customer->role}}</td>

                                        </tr>
                                    @endforeach
                                   </tbody>
                                </table>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>

                <!-- /.row -->


            </div><!--/tab-pane-->
              </div><!--/tab-pane-->
    </div><!--/tab-content-->


@endsection