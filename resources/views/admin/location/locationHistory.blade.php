@extends('admin.master')
@section('title')
    Manage-delivery-Man-Location
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-offset-3 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="text-info" style="text-align: center">Manage Order</h1>
                    @if( $message = Session::get('message') )
                        <h4 class="page-header text-success" style="text-align: center">{{ $message }}</h4>
                    @endif
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>

                            <th>ID</th>
                            <th>Delivery Man ID</th>
                            <th>Longtitude</th>
                            <th>Latitude</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($location as $item)
                            <tr class="odd gradeX">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->delivery_man_id }}</td>
                                <td>{{ $item->latitude }}</td>
                                <td>{{ $item->longtitude }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="{{ url('/view-on-map/'.$item->id) }}" class="btn btn-info btn-xl" title="View On Map">
                                        <span class="glyphicon glyphicon-zoom-in"></span>
                                    </a>

                                </td>
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