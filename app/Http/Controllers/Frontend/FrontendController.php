<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Rating;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $featured_products = Product::where('car_trending', '1')->take(15)->get();
        $trending_category = Category::where('popular','1')->take(15)->get();
            return view("frontend.index", compact('featured_products', 'trending_category'));
    }

    public function category()
    {
        $category = Category::where('status','0')->get();
        return view('frontend.category', compact('category'));
    }

    public function viewcategory($slug)
    {
        if(Category::where('slug', $slug)->exists())
        {
            $category =  Category::where('slug', $slug)->first();
            $products =  Product::where('cate_id', $category->id)->where('car_status', '0')->get();

            return view('frontend.products.index', compact('category','products'));
        }else{
            return redirect('/')->with('status',"Slug does not exit");
        }


    }

    public function productview($slug, $car_name)
    {
        if(Category::where('slug',$slug)->exists())
        {
            if(Product::where('car_name', $car_name)->exists())
            {
                $products = Product::where('car_name', $car_name)->first();
                $ratings = Rating::where('prod_id', $products->id)->get();
                $rating_sum = Rating::where('prod_id', $products->id)->sum('stars_rated');
                if($ratings->count()> 0){
                    $rating_value = $rating_sum/$ratings->count();

                }else{
                    $rating_value = 0;
                }

                return view('frontend.products.view', compact('products', 'ratings' , 'rating_value'));
            }
            else
            {
                return redirect('/')->with('status', 'The link was broken');
            }
        }else{
            return redirect('/')->with('status', 'No category found');
        }

    }
}
