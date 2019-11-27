@extends('frontEnd.master')


@section('title')
    Ecommerce|My-Order
    @endsection

@section('content')
    <div class="container" style="margin-bottom: 100px; ">
        <h1 style="text-align: center">My Order History</h1>
        <div class="row">
        <div class="col-md-offset-2 col-md-8" style="background-color: #F0F0F0; padding: 30px; border-radius: 10px" >
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>OrderID</th>
            <th>Total Cost</th>
            <th>State</th>
            <th>Address</th>
            <th>Mobile Number</th>
            <th>Payment Type</th>
            <th>Order Date</th>
            <th>Current Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($myOrders as $myOrder)
        <tr>
            <td>{{$myOrder->id}}</td>
            <td>{{$myOrder->total_order_cost}}</td>
            <td>{{$myOrder->state}}</td>
            <td>{{$myOrder->address}}</td>
            <td>{{$myOrder->phone}}</td>
            <td>{{$myOrder->payment_type}}</td>
            <td>{{$myOrder->created_at}}</td>
            <td>{{$myOrder->status==0 ?"pending":"Delivered"}}</td>
        </tr>
            @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>OrderID</th>
            <th>Total Cost</th>
            <th>State</th>
            <th>Address</th>
            <th>Mobile Number</th>
            <th>Payment Type</th>
            <th>Order Date</th>
            <th>Status</th>
        </tr>
        </tfoot>
    </table>
        </div>
    </div>
    </div>

@endsection