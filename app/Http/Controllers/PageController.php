<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Package;
use App\Models\Appointment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\ApiPaymentController;
use App\Http\Controllers\Api\ApiAppointmentController;
use DRO\SeoAnalyzer\Http\Controllers\DroSeoAnalyzerController;
use App\Models\{Comment, Custom, Post, Category, Setting, User};
use DRO\SeoAnalyzer\Models\Analyzer;

class PageController extends Controller
{

  public function __construct(Request $request)
  {



      $this->url = request()->segments();
      $this->pages = Post::where('type','page')->take(20)->get();
      $this->page = '';
      if(isset($this->url[1])){
        $this->page = Post::where('slug','LIKE','%'.$this->url[1].'%')->first();
      }


      $this->blogCategories = getChildCategories('post');
      $this->posts = Post::where('type','post')->orderBy('created_at','DESC')->limit(10)->get();
      $this->setting = namedSettings(Setting::all());//DONE
      $this->testimonials = findCustomData('Testimonials');
      $this->partners = findCustomData('Partners');
      $this->user = Auth::user();
      $this->packages =  Package::all();
      $this->currency = $this->setting['currency']->value;
      $this->products = Post::where('type','product')->paginate(12);
      $this->droSeoAnalyzerController = new DroSeoAnalyzerController();
      $this->apiAppointmentController = new ApiAppointmentController();
      $this->apiPaymentController = new ApiPaymentController($request);
  }





  public function index(Request $request)
  {

     $page = Post::where('slug','LIKE','%'.trans('routes.home').'%')->first();





      return view('pages.anasayfa',
      [
        'posts' => $this->posts,
        'page' => $page,
        'analyzations' =>  $this->droSeoAnalyzerController->getAllAnalyzations(5),
        'allAnalyzations' =>  Analyzer::all()->count(),
        'testimonials' => $this->testimonials,
        'partners' => $this->partners,
        'packages' => $this->packages,
        'products' => $this->products,
        'childCategories' => getChildCategories('product'),
        'user' => $this->user,
        'currency' => $this->currency,
        'setting' => $this->setting,
    ]
    );

  }

  //SERVICES  PAGE || /services
  public function services(Request $request)
  {

    $page = Post::where('slug','LIKE','%'.$this->url[0].'%')->first();
    $categories = Category::where('parent_id',3)->get();
    $services = Post::where('type','service')->active()->get();


        return view('pages.services',
      [
        'posts' => $this->posts,
        'services' => $services,
        'categories' => $categories,
        'packages' => $this->packages,
        'page' => $page,
        'user' => $this->user,
        'setting' => $this->setting,
     ]
    );

  }

  //ABOUT US PAGE || /about-us
  public function aboutUs(Request $request)
  {


    $page = Post::where('slug','LIKE','%'.$this->url[0].'%')->first();
    $AboutUSMembers = findCustomData('AboutUSMembers');


    return view('pages.about-us',
      [
        'posts' => $this->posts,
        'page' => $page,
        'AboutUSMembers' => $AboutUSMembers,
        'user' => $this->user,
        'setting' => $this->setting,
     ]
    );

  }

  //OUR TEAM PAGE || /our-team
  public function ourTeam(Request $request)
  {


    $page = Post::where('slug','LIKE','%'.'about-us'.'%')->first();
    $AboutUSMembers = findCustomData('AboutUSMembers');


    return view('pages.about-us',
      [
        'posts' => $this->posts,
        'page' => $page,
        'AboutUSMembers' => $AboutUSMembers,
        'testimonials' => $this->testimonials,
        'user' => $this->user,
        'setting' => $this->setting,
     ]
    );

  }

  //FAQ PAGE || /faq
  public function faq(Request $request)
  {

     $page = Post::where('slug','LIKE','%'.$this->url[0].'%')->first();


    return view('pages.'.$this->url[0],
      [
        'posts' => $this->posts,
        'page' => $page,
        'user' => $this->user,
        'setting' => $this->setting,
     ]
    );

  }

  //404| PAGE NOT FOUND PAGE || /page-not-found
  public function pageNotFound(Request $request)
  {

     $page = Post::where('slug','LIKE','%'.$this->url[0].'%')->first();


    return view('pages.'.$this->url[0],
      [
        'posts' => $this->posts,
        'page' => $page,
        'user' => $this->user,
        'setting' => $this->setting,
     ]
    );

  }

  //CONTACT PAGE || /contact
  public function contact(Request $request)
  {

     $page = Post::where('slug','LIKE','%'.'contact'.'%')->first();



    return view('pages.contact',
      [
        'posts' => $this->posts,
        'page' => $page,
        'user' => $this->user,
        'setting' => $this->setting,
     ]
    );

  }

  //LOGIN PAGE || /login
  public function login(Request $request)
  {

     $page = Post::where('slug','LIKE','%'.$this->url[0].'%')->first();



    return view('pages.login',
      [
        'posts' => $this->posts,
        'page' => $page,
        'user' => $this->user,
        'setting' => $this->setting,
     ]
    );

  }

  //REGISTER PAGE || /register
  public function register(Request $request)
  {

     $page = Post::where('slug','LIKE','%'.$this->url[0].'%')->first();

    return view('pages.register',
      [
        'posts' => $this->posts,
        'page' => $page,
        'user' => $this->user,
        'setting' => $this->setting,
     ]
    );

  }

    //PIRICING PAGE || /pricing
  public function pricing(Request $request)
  {

     $page = Post::where('slug','LIKE','%'.$this->url[0].'%')->first();
    $packages = Package::orderBy('created_at','desc')->get();

    return view('pages.pricing',
            [
                'page' => $page,
                'packages' => $packages,
                'user' => $this->user,
                'setting' => $this->setting,
            ]
        );


    }


    //PORTFOLIOS PAGE || /portfolios
  public function portfolios(Request $request)
  {

     $page = Post::where('slug','LIKE','%'.$this->url[0].'%')->first();
    $portfolios = Post::where('type','portfolio')->orderBy('created_at','desc')->paginate(15);



    return view('pages.portfolios',
            [
                'page' => $page,
                'portfolios' => $portfolios,
                'user' => $this->user,
                'setting' => $this->setting,
            ]
        );


  }


    //BLOG PAGE || /blog
  public function blog(Request $request)
  {


     $page = Post::where('slug','LIKE','%'.'blog'.'%')->first();
    $posts = Post::where('type','post')->orderBy('created_at','desc')->paginate(10);



    return view('pages.blog',
            [
                'page' => $page,
                'posts' => $posts,
                'blogCategories' => $this->blogCategories,
                'user' => $this->user,
                'setting' => $this->setting,
            ]
        );


  }


    //SHOP PAGE || /shop
    public function shop(Request $request)
    {

      $page = Post::where('slug','LIKE','%'.'cozumlerimiz'.'%')->first();
      $products = Post::where('type','product')->orderBy('created_at','desc')->paginate(15);
      $posts = Post::where('type','post')->orderBy('created_at','desc')->paginate(15);
      $currency = $this->setting['currency']->value;

      return view('pages.shop',
              [
                  'page' => $page,
                  'currency' => $currency,
                  'products' => $products,
                  'posts' => $posts,
                  'childCategories' => getChildCategories('product'),
                  'user' => $this->user,
                  'setting' => $this->setting,
              ]
          );


    }


    //CHECKOUT PAGE || /checkout
    public function checkout(Request $request)
    {

      $page = Post::where('slug','LIKE','%'.$this->url[0].'%')->first();
      $products = Post::where('type','product')->orderBy('created_at','desc')->paginate(15);
      $posts = Post::where('type','post')->orderBy('created_at','desc')->paginate(15);
      $currency = $this->setting['currency']->value;
      $user = Auth::user() ? Auth::user() : session()->getId();
      $type = $this->user ? 'user' : 'guest';



      return view('pages.checkout',
              [
                  'page' => $page,
                  'currency' => $currency,
                  'products' => $products,
                  'posts' => $posts,
                  'cart' =>cart($this->user,$type),
                  'cartTotal' => cartTotal($user,$type),
                  'blogCategories' => $this->blogCategories,
                  'user' => $this->user,
                  'setting' => $this->setting,
              ]
          );


    }

    //CART PAGE || /cart
    public function cart(Request $request)
    {

       $page = Post::where('slug','LIKE','%'.$this->url[0].'%')->first();
      $products = Post::where('type','product')->orderBy('created_at','desc')->paginate(15);
      $posts = Post::where('type','post')->orderBy('created_at','desc')->paginate(15);
      $currency = $this->setting['currency']->value;
      $user = auth()->user() ? Auth::user() : session()->getId();
      $type = $this->user ? 'user' : 'guest';




      return view('pages.cart',
              [
                  'page' => $page,
                  'currency' => $currency,
                  'products' => $products,
                  'posts' => $posts,
                  'cart' =>cart($user,$type),
                  'cartTotal' => cartTotal($user,$type),
                  'user' => $this->user,
                  'setting' => $this->setting,
              ]
          );


    }




    //SINGLE PORTFOLI PAGE || /portfolio/portfolio-1
    public function singlePortfolio(Request $request)
    {
        $options = $this->page->options;
        $next = Post::where('type','portfolio')->where('id', '>', $this->page->id)->first();
        $previos = Post::where('type','portfolio')->where('id', '<', $this->page->id)->first();
        $relatedPortfolios = Post::where('type','portfolio')->where('title','LIKE','%'.substr($this->page->title,0,5,).'%')->get();

        return view('pages.sub-pages.portfolio',
                [
                    'page' => $this->page,
                    'options' => $options,
                    'relatedPortfolios' => $relatedPortfolios,
                    'next' => $next,
                    'previos' => $previos,
                    'user' => $this->user,
                    'setting' => $this->setting,
                ]
            );


    }

    //SINGLE SERVICE PAGE || /service/service-1
    public function singleService(Request $request)
    {
        $options = $this->page->options;
        $next = Post::where('type','service')->where('id', '>', $this->page->id)->first();
        $previos = Post::where('type','service')->where('id', '<', $this->page->id)->first();
        $relatedServices = Post::where('type','service')->where('title','LIKE','%'.substr($this->page->title,0,5,).'%')->get();

        return view('pages.sub-pages.service',
                [
                    'page' => $this->page,
                    'options' => $options,
                    'relatedPortfolios' => $relatedServices,
                    'testimonials' => $this->testimonials,
                    'packages' => $this->packages,
                    'next' => $next,
                    'previos' => $previos,
                    'user' => $this->user,
                    'setting' => $this->setting,
                ]
            );


    }


    //SINGLE BlOG POST PAGE || /blog/a-category/post-1
    public function singlePost(Request $request,$catSlug,$postSlug)
    {

        $post =  Post::where('slug','LIKE','%'.$postSlug.'%')->first();
        $options = (object)json_decode($post->options,true);
        $next = Post::where('type','post')->where('id', '>', $post->id)->first();
        $previos = Post::where('type','post')->where('id', '<', $post->id)->first();
        $relatedPosts = Post::where('type','post')->where('title','LIKE','%'.substr($post->title,0,5,).'%')->get();

        return view('pages.sub-pages.blog',
                [
                    'page' => $post,
                    'posts' => $this->posts,
                    'options' => $options,
                    'relatedPosts' => $relatedPosts,
                    'blogCategories' => $this->blogCategories,
                    'next' => $next,
                    'previos' => $previos,
                    'user' => $this->user,
                    'setting' => $this->setting,
                ]
            );


    }


    //SINGLE CATEGORY PAGE || /category/category-1
    public function singleCategory(Request $request,$slug)
    {


      $category = Category::where('slug','LIKE','%'.$slug.'%')->first();
       $page = Post::where('slug','LIKE','%'.$this->url[0].'%')->first();
      $posts = Post::where('type','post')->where('category_id', $category->id)->orderBy('created_at','desc')->paginate(10);


      return view('pages.sub-pages.category',
              [
                  'page' => $category,
                  'posts' => $posts,
                  'blogCategories' => $this->blogCategories,
                  'user' => $this->user,
                  'setting' => $this->setting,
              ]
          );


    }


    //TAG POSTS PAGE || /tag/tag-1
    public function tagPosts(Request $request,$tag)
    {


      $pageData = [
        'title' => $tag. ' '.trans('lang.related_posts'),
        'slug' =>   $tag,
        'seo_title' => ucwords($tag). ' '.trans('lang.related_posts') . ' | '. trans('lang.first_h1_tag'),
        'seo_description' => ucwords($tag). ' '.trans('lang.related_posts') . ' | '. trans('lang.first_p_tag'),
      ];
      $page = createTemporaryPage($pageData);
      $posts =  Post::where('tags','LIKE','%'.$tag.'%')->paginate(15);

      if(!$posts ){
        $posts =  Post::paginate(15);
      }


      return view('pages.sub-pages.tag',
              [
                  'tag' => $tag,
                  'page' => $page,
                  'posts' => $posts,
                  'blogCategories' => $this->blogCategories,
                  'user' => $this->user,
                  'setting' => $this->setting,
              ]
          );


    }


    //SEARCH POSTS || /category/category-1
    public function searchPosts(Request $request,$slug)
    {


      $page = Post::where('slug','LIKE','%'.'category'.'%')->first();
      $posts = Post::where('title','LIKE','%'.$slug.'%')
                    ->where('type','post')
                    ->orWhere('content','LIKE','%'.$slug.'%')
                    ->where('type','post')
                    ->orWhere('options','LIKE','%'.$slug.'%')
                    ->where('type','post')->paginate(15);


      return view('pages.sub-pages.category',
              [
                  'page' => $page,
                  'posts' => $posts,
                  'blogCategories' => $this->blogCategories,
                  'user' => $this->user,
                  'setting' => $this->setting,
              ]
          );


    }


    //SINGLE PRODUCT PAGE || /product/product-1
    public function singleProduct (Request $request,$slug)
    {


        $options = $this->page->options;
        $products = Post::where('type','product')->orderBy('created_at','desc')->paginate(15);
        $currency = $this->setting['currency']->value;
        $commentCount = Comment::where('post_id', $this->page->id)->where('approved',1)->count();
        $relatedProducts = Post::where('type','product')->where('title','LIKE','%'.substr($this->page->title,0,5,).'%')->get();

        return view('pages.sub-pages.product',
                [
                    'page' => $this->page,
                    'posts' => $this->posts,
                    'options' => $options,
                    'products' => $products,
                    'relatedProducts' => $relatedProducts,
                    'blogCategories' => $this->blogCategories,
                    'commentCount' => $commentCount,
                    'currency' => $currency,
                    'user' => $this->user,
                    'setting' => $this->setting,
                ]
            );


    }

    //SINGLE PRODUCT PAGE || /product/product-1
    public function payment (Request $request,$id)
    {

        return $this->apiPaymentController->create_payment($request);

        // $page = Post::where('slug','LIKE','%'.$this->url[0].'%')->first();
        // $currency = $this->setting['currency']->value;
        // $user = Auth::user() ? Auth::user() : session()->getId();
        // $type = $this->user ? 'user' : 'guest';



        // return view('pages.payment',
        //         [
        //             'page' => $page,
        //             'cart' =>cart($this->user,$type),
        //             'cartTotal' => cartTotal($user,$type),
        //             'orderId' => $id,
        //             'currency' => $currency,
        //             'user' => $this->user,
        //             'setting' => $this->setting,
        //         ]
        //     );


    }





    public  function checkoutRegisterOrUpdateInfo (Request $request) {
        $bill_address = [
            'address_line1'=> $request->address_line1,
            'address_line2'=> $request->address_line2,
            'state'=> $request->state,
            'phone'=> $request->phone,
            'city'=> $request->city,
            'country'=> $request->country,
            'post_code' => $request->post_code,
        ];


        if($this->user){
            $this->user->bill_address = json_encode($bill_address);
            $this->user->save();
            return Redirect::route('page.payment',Carbon::now()->timestamp)->withSuccess(trans('lang.you_can_now_go_to_payment'));
        }else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'phone' => 'required',
                'address_line1' => 'required',
                'country' => 'required',
                'post_code' => 'required',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
              ]);

              if ($validator->fails()) {
                return back()->with('errors', $validator->messages()->all()[0])->withInput();
            }
             $createdUser =  User::create([
                'name' => $request->name,
                'email' => $request->email,
                'bill_address' => json_encode($bill_address),
                'address' => json_encode($bill_address),
                'email' => $request->email,
                'phone' => $request->phone,
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt($request->password)
              ]);

              $credentials = $request->only('email', 'password');

              if (Auth::attempt($credentials)) {
                  $token = Auth::guard()->attempt($credentials);
                  setcookie('token', $token, time() + 24 * 60 * 60, '/');
                   return Redirect::route('page.payment',Carbon::now()->timestamp)->withError(trans('lang.you_can_now_go_to_payment'));
              }

             // return redirect('checkout')->withSuccess(trans('lang.please_login_with_credentials_you_created'));


        }


    }


    public  function sendForm  (Request $request) {

        return $this->apiAppointmentController->store($request);
    }


    public  function webSiteSeoAnalysis  (Request $request) {

        $page = Post::where('type','page')->where('slug','LIKE','%'.'website-seo-analysis'.'%')->first();
        $seoInfo        =    session()->get('website');

        if(!$seoInfo) return Redirect::route('page.home')->withError(trans('lang.please_search_a_website_with_search_input'));

       return view('pages.website-seo-analysis',
                [
                    'page' => $page,
                    'seoInfo' => $seoInfo,
                    'user' => $this->user,
                    'setting' => $this->setting,
                ]
            );
    }


    public  function loginFunction  (Request $request)
    {

        if (Auth::attempt($request->only(['email','password']))) {
            $token = Auth::guard()->attempt($request->only(['email','password']));
            setcookie('token', $token, time() + 24 * 60 * 60, '/');
            return redirect()->route('page.home');
        }

    }

    public function registerFunction (Request $request) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required',
              ]);

              if ($validator->fails()) {
                return back()->with('errors', $validator->messages()->all()[0])->withInput();
            }
             $createdUser =  User::create([
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt($request->password)
              ]);

              $credentials = $request->only('email', 'password');

              if (Auth::attempt($credentials)) {
                  $token = Auth::guard()->attempt($credentials);
                  setcookie('token', $token, time() + 24 * 60 * 60, '/');
                   return redirect()->route('page.home')->with('success',trans('lang.register_success'));
              }


        }

   public function changeLanguage (Request $request,$lang) {
       app()->setLocale($lang);
        session()->put('language', $lang);
        $_SESSION['language'] = $lang;
       return redirect('/')->withSuccess(trans('lang.language_changed'));



   }


    public function setLocale (Request $request,$lang) {
        app()->setLocale($request->language);
        session()->put('language', $request->language);
        $_SESSION['language'] = $request->language;
        return  response()->json(session('language'));
    }


        public function sitemap(){
        $posts = Post::where('status', '=', 1)->orderBy('updated_at', 'DESC')->get();
        $now = Carbon::now()->toAtomString();
        $content = view('sitemap.sitemap', compact('posts','now'));
        return response($content)->header('Content-Type', 'application/xml');
    }


        public function emailTemplate()
        {
        // $data = Appointment::find(10);
        $data = Analyzer::find(22);

        //return view('mail.contact-email',
        return view('mail.seo-analyzer-mail',
            [
                'data' => $data,
                'user' => $this->user,
                'setting' => $this->setting,
            ]
            );
         }
}
