
<!--===============================================================================================-->
<script type="text/javascript" src="{{asset('/frontAsset/')}}/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{asset('/frontAsset/')}}/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{asset('/frontAsset/')}}/vendor/bootstrap/js/popper.js"></script>
<script type="text/javascript" src="{{asset('/frontAsset/')}}/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{asset('/frontAsset/')}}/vendor/select2/select2.min.js"></script>
<script type="text/javascript">
    $(".selection-1").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });
</script>



<!--===============================================================================================-->
<script type="text/javascript" src="{{asset('/frontAsset/')}}/vendor/slick/slick.min.js"></script>
<script type="text/javascript" src="{{asset('/frontAsset/')}}/js/slick-custom.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{asset('/frontAsset/')}}/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{asset('/frontAsset/')}}/vendor/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{asset('/frontAsset/')}}/vendor/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.block2-btn-addcart').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        $(this).on('click', function(){
            swal(nameProduct, "is added to cart !", "success");
        });
    });

    $('.block2-btn-addwishlist').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        $(this).on('click', function(){
            swal(nameProduct, "is added to wishlist !", "success");
        });
    });
</script>

<!--===============================================================================================-->
<script type="text/javascript" src="{{asset('/frontAsset/')}}/vendor/parallax100/parallax100.js"></script>
<script type="text/javascript">
    $('.parallax100').parallax100();
</script>
<!--===============================================================================================-->
<script src="{{asset('/frontAsset/')}}/js/main.js"></script>




@yield('additionalScript')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>


<script>
    $(document).ready(function() {

        //setInterval( "alert('Hello')", 5000 );



        $('#example').DataTable();
    } );$(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
</body>
</html>
