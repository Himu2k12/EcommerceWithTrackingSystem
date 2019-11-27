<?php

namespace App\Http\Controllers;

use App\DeliveryManOnOrder;
use App\LocationHistory;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\DB;

class AdminWelcomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function ShowDashboard(){
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }

        return view('admin.dashboard.dashboard-content');
    }
    public function ShowCustomer(){
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $customers=DB::table('users')
            ->select('*')
            ->where('role','=','user')
            ->get();
        return view('admin.users.customerView',['customers'=>$customers]);
    }
    public function ShowDealer(){
        if(!Gate::allows('isAdmin')){
            abort('404','you cannot access here');
        }
        $customers=DB::table('users')
            ->select('*')
            ->where('role','=','delivery')
            ->get();



        return view('admin.users.dealerView',['customers'=>$customers,

        ]);

    }
    public function ShowArtist(){
        $customers=DB::table('users')
            ->select('*')
            ->where('role','=','artist')
            ->get();
        $posts = DB::table('posts')
            ->leftJoin('users', 'users.id', '=', 'posts.customer_id')
            ->leftJoin('user_profiles', 'user_profiles.customer_id', '=', 'posts.customer_id')
            ->leftJoin('artist_profiles', 'artist_profiles.artist_id', '=', 'posts.customer_id')
            ->select('posts.*', 'users.name','users.role','artist_profiles.artist_pp')
            ->where([['users.role','=','artist'],['posts.delete_post','=',0]])
            ->orderBy('posts.id', 'desc')
            ->get();

        return view('admin.users.artistView',['customers'=>$customers,'posts'=>$posts]);
    }
    public function disableBrandInfo($id) {
        $brandById = User::find($id);
        $brandById->access = 0;
        $brandById->save();
        return redirect('/admin-view-brand')->with('message', 'Brand access disabled successfully ');
    }
    public function activeBrandInfo($id) {
        $brandById = User::find($id);
        $brandById->access = 1;
        $brandById->save();
        return redirect('/admin-view-brand')->with('message', 'Brand access enabled successfully');
    }
    public function viewBrandDetails($id) {
        $BrandById = DB::table('brand_details')
            ->join('users','users.id','=','brand_details.user_id')
            ->select('brand_details.*','users.*')
            ->where('user_id','=',$id)
            ->first();
        return view('admin.users.brand-details',['BrandById'=>$BrandById]);
    }
    public function disableArtistInfo($id) {
        $ArtistById = User::find($id);
        $ArtistById->access = 0;
        $ArtistById->save();
        return redirect('/admin-view-artist')->with('messageCancel', 'Artist account Verification Canceled ');
    }
    public function activeArtistInfo($id) {
        $ArtistById = User::find($id);
        $ArtistById->access = 1;
        $ArtistById->save();
        return redirect('/admin-view-artist')->with('messageVerify', 'Artist account Verified successfully');
    }
    public function viewArtistDetails($id) {
        $ArtistById = DB::table('artist_profiles')
            ->join('users','users.id','=','artist_profiles.artist_id')
            ->select('artist_profiles.*','users.name','users.email')
            ->where('artist_profiles.artist_id','=',$id)
            ->first();
        return view('admin.users.artist-details',['ArtistById'=>$ArtistById]);
    }
    public function viewOrder(){
        $customerOrder=DB::table('orders')
            ->select('*')
            ->orderby('id','desc')
            ->get();

        //dd($customerOrder);
        return view('admin.Order.customer-order',['customerOrder'=>$customerOrder]);
    }
    public function viewOrderBrand(){
        $customerOrder=DB::table('orders')
            ->select('*')
            ->orderby('id','desc')
            ->get();

        //dd($customerOrder);
        return view('admin.Order.brand-order',['customerOrder'=>$customerOrder]);
    }
    public function detailsOrder($id){

        $customerOrder=Order::find($id);

        $customer=User::find($customerOrder->user_id);
        $products=DB::table('order_details')
            ->join('products','products.id','=','order_details.product_id')
            ->select('order_details.*','products.product_name')
            ->where('order_details.order_id','=',$customerOrder->id)
            ->get();


        $deliveryMen=User::where('role',"delivery")->get();
        $checkOrderSetting=DeliveryManOnOrder::where('order_id',$id)->count();


        return view('admin.Order.view-order-details',['customerOrder'=>$customerOrder,
            'customer'=>$customer,
            'products'=>$products,
            'deliveryMen'=>$deliveryMen,
            'checkOrderSetting'=>$checkOrderSetting,
        ]);
    }
    public function confirmDelivery($id){
        $orderCustomer=Order::find($id);
        $orderCustomer->status=1;
        $orderCustomer->save();
        return redirect('/order-view')->with('message','Order delivered');
    }
    public function confirmDeliverybrand($id){
        $orderCustomer=Order::find($id);
        $orderCustomer->status=1;
        $orderCustomer->save();
        return redirect('/order-view-brand')->with('message','Order delivered');
    }
    public function CreateDeliveryMan(){
        $users=User::where('role','user')->get();
        return view('admin.users.create-delivery',['users'=>$users]);
    }
    public function saveDel(Request $request){
        $users=User::find($request->user_id);
        $users->role="delivery";
        $users->save();
        return redirect('/admin-create-delivery-man');
    }
    public function locationHistory(){
        $location=LocationHistory::all();

        return view('admin.location.locationHistory',['location'=>$location]);
    }
    public function showlocation($id){

        $history=LocationHistory::find($id);

        return view('admin.location.map-view',['history'=>$history]);
    }
}
