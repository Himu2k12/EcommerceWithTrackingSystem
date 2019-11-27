@extends('admin.master')
@section('title')
   ADD DELIVERY MAN
@endsection
@section('content')
    <br/>
    <div class="row">
        <div class="col-sm-offset-3 col-sm-8">
            <div class="well">

                <h1 class="text-info" style="text-align: center">Add Delivery Man</h1>
                <h3 style="text-align: center" class="text-info">{{ Session::get('message') }}</h3>
                <form action="{{ url('/save-delivery') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                   <div class="form-group">
                        <label class="col-sm-3">Publication Status</label>
                        <div class="col-sm-9">
                            <select name="user_id" class="form-control">
                                <option>---Select Status---</option>
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <input type="submit" name="btn" class="btn btn-success btn-block" value="Make Delivery Man"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection