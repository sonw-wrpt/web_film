<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;


class IndexController extends Controller
{
    public function home()
    {
        $hotmovie           = Movie::where('hotmovie', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->get();
        $hotmovie_sidebar   = Movie::where('hotmovie', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(20)->get();
        $upcoming_movie     = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'DESC')->take(10)->get();
        $category           = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre              = Genre::orderBy('id', 'ASC')->get();
        $country            = Country::orderBy('id', 'ASC')->get();
        $category_home      = Category::with('movie')->orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.home', compact('category', 'genre', 'country', 'category_home', 'hotmovie', 'hotmovie_sidebar', 'upcoming_movie'));
    }

    public function category($slug)
    {
        $category           = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre              = Genre::orderBy('id', 'DESC')->get();
        $country            = Country::orderBy('id', 'DESC')->get();
        $cate_slug          = Category::where('slug', $slug)->first();
        $movie              = Movie::where('category_id', $cate_slug->id)->orderBy('updated_at', 'DESC')->paginate(40);
        $hotmovie_sidebar   = Movie::where('hotmovie', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(15)->get();
        $upcoming_movie     = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'DESC')->take(10)->get();
        return view('pages.category', compact('category', 'genre', 'country', 'cate_slug', 'movie', 'hotmovie_sidebar', 'upcoming_movie'));
    }

    public function year($year)
    {
        $category           = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre              = Genre::orderBy('id', 'DESC')->get();
        $country            = Country::orderBy('id', 'DESC')->get();
        $year               = $year;
        $movie              = Movie::where('year', $year)->orderBy('updated_at', 'DESC')->paginate(40);
        $hotmovie_sidebar   = Movie::where('hotmovie', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(15)->get();
        $upcoming_movie     = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'DESC')->take(10)->get();
        return view('pages.year', compact('category', 'genre', 'country', 'year', 'movie', 'hotmovie_sidebar', 'upcoming_movie'));
    }

    public function tag($tag)
    {
        $category           = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre              = Genre::orderBy('id', 'DESC')->get();
        $country            = Country::orderBy('id', 'DESC')->get();
        $tag                = $tag;
        $movie              = Movie::where('tags', 'LIKE', '%' . $tag . '%')->orderBy('updated_at', 'DESC')->paginate(40);
        $hotmovie_sidebar   = Movie::where('hotmovie', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(15)->get();
        $upcoming_movie     = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'DESC')->take(10)->get();
        return view('pages.tag', compact('category', 'genre', 'country', 'tag', 'movie', 'hotmovie_sidebar', 'upcoming_movie'));
    }

    public function genre($slug)
    {
        $category           = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre              = Genre::orderBy('id', 'DESC')->get();
        $country            = Country::orderBy('id', 'DESC')->get();
        $genre_slug         = Genre::where('slug', $slug)->first();
        $movie              = Movie::where('genre_id', $genre_slug->id)->orderBy('updated_at', 'DESC')->paginate(40);
        $hotmovie_sidebar   = Movie::where('hotmovie', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(15)->get();
        $upcoming_movie     = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'DESC')->take(10)->get();
        return view('pages.genre', compact('category', 'genre', 'country', 'genre_slug', 'movie', 'hotmovie_sidebar', 'upcoming_movie'));
    }

    public function country($slug)
    {
        $category           = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre              = Genre::orderBy('id', 'DESC')->get();
        $country            = Country::orderBy('id', 'DESC')->get();
        $country_slug       = Country::where('slug', $slug)->first();
        $movie              = Movie::where('country_id', $country_slug->id)->orderBy('updated_at', 'DESC')->paginate(40);
        $hotmovie_sidebar   = Movie::where('hotmovie', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(15)->get();
        $upcoming_movie     = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'DESC')->take(10)->get();
        return view('pages.country', compact('category', 'genre', 'country', 'country_slug', 'movie', 'hotmovie_sidebar', 'upcoming_movie'));
    }

    public function movie($slug)
    {
        $category           = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre              = Genre::orderBy('id', 'DESC')->get();
        $country            = Country::orderBy('id', 'DESC')->get();
        $movie              = Movie::with('category', 'genre', 'country')->where('slug', $slug)->where('status', 1)->first();
        $related            = Movie::with(['category', 'genre', 'country'])->where('category_id', $movie->category->id)->where('slug', '!=', $slug)->inRandomOrder()->get();
        $hotmovie_sidebar   = Movie::where('hotmovie', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->take(15)->get();
        $upcoming_movie     = Movie::where('resolution', 4)->where('status', 1)->orderBy('updated_at', 'DESC')->take(10)->get();
        return view('pages.movie', compact('category', 'genre', 'country', 'movie', 'related', 'hotmovie_sidebar', 'upcoming_movie'));
    }

    public function watch()
    {
        return view('pages.watch');
    }

    public function episode()
    {
        return view('pages.episode');
    }
}
