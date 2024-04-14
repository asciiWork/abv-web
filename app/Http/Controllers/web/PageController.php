<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ProductImages;
use App\Models\Contact;
use App\Models\Carts;
use App\Models\Order;
use App\Models\TempOrder;
use App\Models\TempOrderDetail;
use App\Models\OrderDetail;
use App\Models\UserAddresses;
use App\Models\User;
use Validator;
use Rap2hpoutre\FastExcel\FastExcel;

class PageController extends Controller
{
    public function index()
    {
        $data = array();
        $data['page_title'] = 'Home';
        $catData = new Categories; 
        $cat =  $catData->get_category();
        $data['Catdata']=$cat;
        $proData = new Product; 
        $product =  $proData->get_Allproduct();
        $data['productData']=$product;
        $latestProduct =  $proData->get_latest_product(5);
        $data['letProductData']=$latestProduct;
        $dealProduct =  $proData->get_latest_product(1);
        $data['dealProduct']=$dealProduct;
        $newPro =  $proData->get_NewArrivals();
        $data['newProData']=$newPro;
        $data['recentPro'] =  $proData->get_BestSellerOrRecent('recent');
        $data['bestSeller'] =  $proData->get_BestSellerOrRecent('best_seller');
        return view('web.index', $data);
    }
    public function about()
    {
        $data = array();
        $data['page_title'] = 'About';
        $data['breadcrumb'] = 'About';
        $proreview = new ProductReview; 
        $prore =  $proreview->get_ProductWithReview();
        $data['proReview']=$prore;
        return view('web.about', $data);
    }
    public function products(Request $request)
    {
        $search_product=$request->get('search_product');
        $data = array();
        $data['page_title'] = 'Products';
        $data['breadcrumb'] = 'Products';
        $proData = new Product; 
        $product =  $proData->get_Allproduct($search_product);
        $data['productData']=$product;
        $newPro =  $proData->get_NewArrivals();
        $data['newProData']=$newPro;
        $data['recentPro'] =  $proData->get_BestSellerOrRecent('recent');
        $data['bestSeller'] =  $proData->get_BestSellerOrRecent('best_seller');
        return view('web.products', $data);
    }
    public function searchProduct(Request $request)
    {
        $query = $request->input('q');
        $products = \DB::table('product')
            ->select(['product.id', 'product.product_name', 'product.product_detail', 'product_img.product_img_url','product_img.pro_main'])
            ->join('product_img', "product.id", "=", "product_img.product_id")
            ->leftJoin('product_category', 'product_category.id', '=', 'product.category_id')
            ->where('product_category.status', '1')
            ->where('product_img.pro_main', '1')
            ->where('product.product_name', 'like', "%$query%")
            ->orWhere('product.product_detail', 'like', "%$query%")
            ->get(['product.id', 'product.product_name', 'product.product_detail','product_img.product_img_url']);

        return response()->json($products);
    }
    public function contact()
    {
        $data = array();    
        $data['page_title'] = 'Contact';
        $data['breadcrumb'] = 'Contact';
        return view('web.contact', $data);
    }
    public function checkContactForm(Request $request)
    {
        $status = 0;
        $msg = "";

        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
        ]);
        // check validations
        if ($validator->fails()) {
            $messages = $validator->messages();
            $status = 0;
            $msg = "";
            foreach ($messages->all() as $message) {
                $msg .= $message . "<br />";
            }
        } else {
            $contactFrm = new Contact();
            $contactFrm->firstname = $request->get('firstname');
            $contactFrm->lastname = $request->get('lastname');
            $contactFrm->phone_number = $request->get('phone_number');
            $contactFrm->email = $request->get('email');
            $contactFrm->message = $request->get('message');
            $contactFrm->save();
            $status = 1;
            $msg = "We will contact you as soon as possible.";

            \Mail::send(new \App\Mail\ContactEmail($contactFrm->id));


        }
        if ($request->isXmlHttpRequest()) {
            return ['status' => $status, 'msg' => $msg];
        } else {
            if ($status == 0) {
                session()->flash('error_message', $msg);
            }
            return redirect('contact');
        }
    }
    public function privacyPolicy()
    {
        $data = array();
        $data['page_title'] = 'Privacy Policy';
        $data['breadcrumb'] = 'Privacy Policy';
        return view('web.privacyPolicy', $data);
    }
    public function termsAndConditions()
    {
        $data = array();
        $data['page_title'] = 'Terms And Conditions';
        $data['breadcrumb'] = 'Terms And Conditions';
        return view('web.termsAndConditions', $data);
    }
    public function refundAndCancellationPolicy()
    {
        $data = array();
        $data['page_title'] = 'Refund And Cancellation Policy';
        $data['breadcrumb'] = 'Refund And Cancellation Policy';
        return view('web.refundAndCancellationPolicy', $data);
    }
    public function deliveryAndShippingPolicy()
    {
        $data = array();
        $data['page_title'] = 'Delivery And Shipping Policy';
        $data['breadcrumb'] = 'Delivery And Shipping Policy';
        return view('web.deliveryAndShippingPolicy', $data);
    }
    public function catalog()
    {
        $data = array();
        $data['page_title'] = 'Delivery And Shipping Policy';
        $data['breadcrumb'] = 'Catalog';
        return view('web.catalog', $data);
    }
    public function categories()
    {
        $data = array();
        $data['page_title'] = 'Categories';
        // $data['breadcrumb'] = 'Categories';
        $catData = new Categories; 
        $cat =  $catData->get_category();
        $data['Catdata']=$cat;
        return view('web.categories', $data);
    }
    public function productDetails($slug)
    {
        $data = array();
        $data['page_title'] = 'Product Details';
        $data['breadcrumb'] = 'Product Details';
        $proData = new Product; 
        $product =  $proData->get_ProductDetail($slug);
        $data['proData']=$product;
        $data['productSize'] = $proData->productSize($product->id);
        $productWithSize = $proData->productWithSize($product->id);
        $data['productWithSize']=$productWithSize;
        $catquery = new Categories;
        $productCategory = $catquery->get_category($product->category_id);
        $data['catData']=$productCategory;
        $proimgs = new ProductImages; 
        $proimges =  $proimgs->get_ProductImages($product->id);
        $proimgesSmall =  $proimgs->get_ProductImagesSmall($product->id);
        $data['proimges']=$proimges;
        $data['proimgesSmall']=$proimgesSmall;
        $proreview = new ProductReview; 
        $prore =  $proreview->get_ProductReview($product->id);
        $data['proReview']=$prore;
        $pwr =  $proreview->get_ProductWithReview($product->id);
        $data['pwr']=$pwr;
        $avgRate =  $proreview->getAvgRating($product->id);
        $data['avgRate']=$avgRate;
        $ranProduct =  $proData->get_random_product();
        $data['ranProduct']=$ranProduct;
        return view('web.productDetails', $data);
    }
    public function productCategory()
    {
        $data = array();
        $data['page_title'] = 'Product Category';
        $data['breadcrumb'] = 'Product Category';
        $catData = new Categories; 
        $cat =  $catData->get_Menucategory();
        $data['Catdata']=$cat;
        $proData = new Product; 
        $product =  $proData->get_Allproduct();
        $data['productData']=$product;
        return view('web.productCategory', $data);
    }
    public function categoryDetails($slug){
        $data = array();
        $data['page_title'] = 'Product Category';
        $data['breadcrumb'] = 'Product Category';
        $catData = new Categories; 
        $cat =  $catData->get_Menucategory();
        $data['Catdata']=$cat;
        $proData = new Product; 
        $product =  $proData->get_Allproduct();
        $data['productData']=$product;
        if($slug){
            $cat=$catData->get_categoryBy_slug($slug);
            $data['Catsl'] = $cat; 
            $data['catPro'] =  $proData->get_catProduct($cat[0]->id);
        }
        return view('web.productCategory', $data);
    }
    public function cart()
    {
        $data = array();
        $data['page_title'] = 'Cart';
        $data['breadcrumb'] = 'Cart';
        $cartData = Carts::getCartData();
        $data['cartData'] = $cartData;
        $proData = new Product;
        $ranProduct =  $proData->get_random_product();
        $data['ranProduct']=$ranProduct;
        return view('web.cart', $data);
    }
    public function gallery()
    {
        $data = array();
        $data['page_title'] = 'Gallery';
        $data['breadcrumb'] = 'Gallery';
        return view('web.gallery', $data);
    }
    public function viewReceivedOrder($id,$key){
        $tObj = Order::where('id',$id)->where('ordkey',$key)->where('order_status',Carts::$PLACED)->where('payment_status','paid')->first();
        if($tObj){
            $data['order'] = $tObj;
            $data['orderDet'] = OrderDetail::getOrders($id);
            return view('web.orderComplete', $data);
        }else{
            return redirect()->route('web.index');
        }
    }
    public function viewOrderPay($id,$key){
        if($id){
            $tObj = TempOrder::where('id',$id)->where('ordkey',$key)->where('order_status',Carts::$PLACED)->first();
            if($tObj){
                session()->put('orderId',$id);
                $data['order'] = $tObj;
                $data['orderDet'] = TempOrderDetail::getOrders($id);
                return view('web.orderPay', $data);
            }
        }
        return abort(404);
    }
    public function addReviewForm(Request $request){
        $uadd = new ProductReview();
        $uadd->category_id=$request->get('category_id');
        $uadd->product_id=$request->get('product_id');
        $uadd->review_rate=$request->get('rate_c');
        $uadd->review=$request->get('review_text');
        $uadd->review_name=$request->get('review_name');
        $uadd->review_email=$request->get('review_email');
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'review_text' => 'required|min:5',
            'review_name' => 'required',
            'review_email' => 'required|email',
        ]);
        $status = 0;
        $msg = "Add Valid Data";
        if ($validator->fails()) {
            $messages = $validator->messages();
            $status = 0;
            $msg = "";
            foreach ($messages->all() as $message) {
                $msg .= $message . "<br />";
            }
        }else{
            if(\Auth::check()){
                $authUser = \Auth::user();
                $uadd->user_id=$authUser->id;
            }
            $uadd->save();
            $status = 1;
            $msg = 'Review has been added!';
        }
        return ['status' => $status, 'msg' => $msg];
    }
    public function forgotPassword()
    {
        $data = array();
        $data['page_title'] = 'Forgot Password';
        $data['breadcrumb'] = 'Forgot Password';
        return view('web.forgotPassword',$data);
    }
    public function forgotPasswordPost(Request $request)
    {
        $data = array();
        $status = 0;
        $msg = 'Please try again later!';

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email', 
        ]);        
        // check validations
        if ($validator->fails())
        {
            $messages = $validator->messages();            
            $status = 0;
            $msg = "";            
            foreach ($messages->all() as $message){
                $msg .= $message . "<br />";
            }
        }         
        else
        {
            $email = $request->get('email');
            $user = User::where('email',$email)->first();
            if($user){
                $keyPass = Contact::generatePassword(20);
                $user->activation_key = $keyPass;
                $user->save();

                $mData = array();
                $mData['user'] = $user;
                $mData['email'] = $user->email;
                $mData['link'] = route('reset-password-link',['email' => $user->email,'activation_key'=>$keyPass]);
                \Mail::send(new \App\Mail\ForgotPassword($mData));

                $status = 1;
                $msg = 'We have sent you an email so that you can restore your password.';
            }
        }
        return ['status' => $status, 'msg' => $msg, 'data' => $data];
    }
    public function resetPasswordLink($email,$activation_key)
    {
        $user = User::where('email',$email)->where('activation_key',$activation_key)->first();
        if(!$user)
            return redirect('/');
 
        return view('web.resetPassword',['activation_key' => $activation_key]);
    }
    public function resetPassword(Request $request)
    {
        $status = 1;
        $msg = 'Password has been updated!';

        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) 
        {
            $messages = $validator->messages();
            $status = 0;
            $msg = "";
            foreach ($messages->all() as $message) 
            {
                $msg .= $message . "<br />";
            }            
        }
        else
        {
            $newPassword = $request->get('password');
            $user = User::where('email',$request->get('email'))
                        ->where('activation_key',$request->get('activation_key'))
                        ->first();
            if($user)
            {
                $user->password = bcrypt($request->get('password'));
                $user->activation_key = '';
                $user->save();
            }
            else
            {
                $status = 0;
                $msg = 'User not found!';
            }
        }        
        return ['status' => $status, 'msg' => $msg];
    }
}
