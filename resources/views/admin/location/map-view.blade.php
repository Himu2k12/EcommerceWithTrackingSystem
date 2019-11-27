@extends('frontEnd.master')

@section('title')
    Order Tracking

@endsection

@section('content')
    <!-- Title Page -->

    <!-- content page -->
    <section class="bgwhite p-t-66 p-b-60">
        <div class="container">
            <h4 style="text-align: center" class="text-danger" >{{ Session::get('mess') }}</h4>

            <div class="row">
                <div class="col-md-12 p-b-30">
                        <div class="contact-map size21" id="google_map" data-map-x="{{$history->latitude}}" data-map-y="{{$history->longtitude}}" data-pin="{{asset('frontAsset/')}}/images/icons/marker.png" data-scrollwhell="0" data-draggable="1"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>



@endsection

@section('additionalScript')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnHLHIsPcpIhgHRBgesQS1cUPUiZE9a7Y"></script>
    <script src="{{asset('/frontAsset/')}}/js/map-custom.js"></script>

@endsection