@extends('frontEnd.master')

@section('title')
    Order Tracking

@endsection

@section('content')
    <!-- Title Page -->
    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(frontAsset/images/cont.jpg);">
        <h2 class="l-text2 t-center">

        </h2>
    </section>

    <!-- content page -->
    <section class="bgwhite p-t-66 p-b-60">
        <div class="container">
            <h4 style="text-align: center" class="text-danger" >{{ Session::get('mess') }}</h4>

            <div class="row">

                <div class="col-md-12 p-b-30">
                    @php $long=1; @endphp
                    Tracking
                    <div id="long">

                    </div>
                    <form class="leave-comment" action="{{url('/check-order')}}" method="post">
                        @csrf
                        <h4 class="m-text26 p-b-36 p-t-15">
                            Please give your Order ID
                        </h4>

                        <div class="bo4 of-hidden size15 m-b-20">
                            <input id="order" class="sizefull s-text7 p-l-22 p-r-22" type="number" name="order_id" placeholder="Order ID">
                        </div>

                        <div class="w-size25">
                            <!-- Button -->

                        </div>
                    </form>
                    <button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" onclick="getLocation()">submit</button>

                </div>


            </div>
            <div class="row">
                <div class="col-md-12 p-b-30">
                    <div class="p-r-20 p-r-0-lg map-div">
                        <div class="contact-map size21" id="google_map" data-map-x="23.814165" data-map-y="90.428001" data-pin="frontAsset/images/icons/marker.png" data-scrollwhell="0" data-draggable="1"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>



@endsection

@section('additionalScript')

    <script>
        var lat;
        var lng;

        function getLocation(){
            var id=document.getElementById("order").value;

            $.ajax({
                type: 'POST',
                url: '{{url('/check-order')}}',
                data: {order_id:id,"_token":"{{csrf_token()}}"},
                dataType: 'json'
            }).done(function( msg ) {
                console.log(msg);
                lat=msg['latitude'];
                lng=msg['longtitude'];
            });
        }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnHLHIsPcpIhgHRBgesQS1cUPUiZE9a7Y"></script>
    <script src="{{asset('/frontAsset/')}}/js/testMap.js"></script>
    <script>

    </script>
@endsection