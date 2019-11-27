@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if( $message = Session::get('message') )
                <h1 class="page-header">{{ $message }}</h1>
            @endif
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-offset-3 col col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center">
                  Order Details
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <h1>Customer Info</h1>
                    <hr/>
                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Customer Name</th>
                            <td>{{ $customer->name}}</td>
                        </tr>
                        <tr>
                            <th>Customer Email</th>
                            <td>{{ $customer->email }}</td>
                        </tr>
                        <tr>
                            <th>User Type</th>
                            <td>{{ $customer->role }}</td>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                    <h1>Shipping Info</h1>
                    <hr/>
                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Address</th>
                            <td>{{ $customerOrder->address }}</td>
                        </tr>
                        <tr>
                            <th>State</th>
                            <td>{{ $customerOrder->state }}</td>
                        </tr>
                        <tr>
                            <th>Post Code</th>
                            <td>{{ $customerOrder->post_code }}</td>
                        </tr>
                        <tr>
                            <th>Mobile Number</th>
                            <td>{{ $customerOrder->phone }}</td>
                        </tr>
                        <tr>
                            <th>Payment Type</th>
                            <td>{{ $customerOrder->payment_type }}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>{{ $customerOrder->total_order_cost }}</td>
                        </tr>

                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <h1>Product Info</h1>
                    <hr/>
                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>SL No</th>
                            <th>Product Id</th>
                            <th>Product Name</th>
                            <th>Product Net Price</th>
                            <th>Product Quantity</th>
                            <th>Total Price</th>
                        </tr>
                        @php($i=1)
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $product->product_id }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>TK. {{ $product->net_price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>TK. {{ $product->total_amount }}</td>

                            </tr>
                        @endforeach
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.panel-body -->
            </div>
                        <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    @if($checkOrderSetting==0)
    <div class="row">
        <div class="col-sm-offset-3 col-sm-8">
            <div class="well">

                <h1 class="text-info" style="text-align: center">Add Brand</h1>
                <h3 style="text-align: center" class="text-info">{{ Session::get('message') }}</h3>
                <form action="{{ url('/allocate-deliveryman') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-sm-3">Order ID</label>
                        <div class="col-sm-9">
                            <input type="text" name="brand_name" class="form-control" value="{{$customerOrder->id}}" disabled />
                            <input type="hidden" name="order_id" class="form-control" value="{{$customerOrder->id}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3">Delivery Man Name(ID)</label>
                        <div class="col-sm-9">
                            <select name="deliveryman_id" class="form-control">
                                <option>---Select Delivery Man---</option>
                                @foreach($deliveryMen as $deliveryMan)
                                <option value="{{$deliveryMan->id}}">{{$deliveryMan->name}}(#{{$deliveryMan->id}})</option>
                                    @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <input type="submit" name="btn" class="btn btn-success btn-block" value="Allocate Delivery Man"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
@endsection