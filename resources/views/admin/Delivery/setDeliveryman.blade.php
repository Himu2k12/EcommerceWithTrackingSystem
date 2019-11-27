@extends('admin.master')
@section('title')
    Manage-Customer-order
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-offset-3 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="text-info" style="text-align: center">Delivery Man Allocation on Order</h1>
                    @if( $message = Session::get('message') )
                        <h4 class="page-header text-success" style="text-align: center">{{ $message }}</h4>
                    @endif
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Order ID</th>
                            <th>Deliver Man ID</th>
                            <th>Deliver Man Name</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($deliveryManOnOrder as $deliveryManOnOr)
                            <tr class="odd gradeX">
                                <td>{{ $i++ }}</td>
                                <td>{{ $deliveryManOnOr->order_id }}</td>
                                <td>{{ $deliveryManOnOr->delivery_man_id }}</td>
                                <td>{{ $deliveryManOnOr->name }}</td>
                                <td>{{ $deliveryManOnOr->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
@endsection