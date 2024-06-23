<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use Carbon\Carbon;
use Storage;
use Illuminate\Support\Facades\File;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $list = Movie::with('category', 'genre', 'country',)->orderBy('id', 'DESC')->get();

        $path = public_path() . "/json";

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        File::put($path . '/movies.json', json_encode($list));
        // dd($path);
        return view('admincp.movie.index', compact('list'));
    }

    public function update_year(Request $request)
    {
        $data   = $request->all();
        $movie  = Movie::find($data['movie_id']);
        $movie->year = $data['year'];
        $movie->save();
    }

    public function update_season(Request $request)
    {
        $data   = $request->all();
        $movie  = Movie::find($data['movie_id']);
        $movie->season = $data['season'];
        $movie->save();
    }

    // public function update_topview(Request $request)
    // {
    //     $data   = $request->all();
    //     $movies = Movie::find($data['movie_id']);
    //     $movies->topview = $data['topview'];
    //     $movies->save();
    // }

    // public function filter_topview(Request $request)
    // {
    //     $data = $request->all();
    //     $movies = Movie::where('topview', $data['value'])->orderBy('updated_at', 'DESC')->take(15)->get();
    //     $output = '';
    //     foreach ($movies as $key => $movie) {
    //         $resolution = '';
    //         if ($movie->resolution == 0) {
    //             $resolution = '2K';
    //         } elseif ($movie->resolution == 1) {
    //             $resolution = 'Full HD';
    //         } elseif ($movie->resolution == 2) {
    //             $resolution = 'HD';
    //         } else {
    //             $resolution = 'SD';
    //         }
    //         $output .= '
    //             <div class="item post-37176">
    //                 <a href="' . url('phim/' . $movie->slug) . '" title="' . $movie->title . '">
    //                     <div class="item-link">
    //                         <img src="' . url('uploads/movie/' . $movie->image) . '" class="lazy post-thumb" alt="' . $movie->title . '" title="' . $movie->title . '" />
    //                         <span class="is_trailer">' . $resolution . '</span>
    //                     </div>
    //                     <p class="title">' . $movie->title . '</p>
    //                 </a>
    //                 <div class="viewsCount" style="color: #9d9d9d;">35000 lượt xem</div>
    //                 <div style="float: left;">
    //                     <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;">
    //                         <span style="width: 0%"></span>
    //                     </span>
    //                 </div>
    //             </div>
    //         ';
    //     }
    //     return response()->json($output); 
    // }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $category = Category::pluck('title', 'id');
        $genre    = Genre::pluck('title', 'id');
        $country  = Country::pluck('title', 'id');

        return view('admincp.movie.form', compact('category', 'genre', 'country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data  = $request->all();
        $movie = new Movie();

        $movie->title       = $data['title'];
        $movie->tags        = $data['tags'];
        $movie->name_movie  = $data['name_movie'];
        $movie->trailer     = $data['trailer'];
        $movie->time_movie  = $data['time_movie'];
        $movie->resolution  = $data['resolution'];
        $movie->subtitle    = $data['subtitle'];
        $movie->slug        = $data['slug'];
        $movie->hotmovie    = $data['hotmovie'];
        $movie->description = $data['description'];
        $movie->status      = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->country_id  = $data['country_id'];
        $movie->genre_id    = $data['genre_id'];
        $movie->created_at  = Carbon::now('Asia/Ho_Chi_Minh');

        $get_image = $request->file('image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image     = current(explode('.', $get_name_image));
            $new_image      = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/movie', $new_image);
            $movie->image   = $new_image;
        }

        $movie->save();
        return redirect()->back()->with('status', 'Thêm phim thành công!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::pluck('title', 'id');
        $genre    = Genre::pluck('title', 'id');
        $country  = Country::pluck('title', 'id');

        $movie    = Movie::find($id);
        return view('admincp.movie.form', compact('category', 'genre', 'country', 'movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data  = $request->all();
        $movie = Movie::find($id);

        $movie->title       = $data['title'];
        $movie->tags        = $data['tags'];
        $movie->name_movie  = $data['name_movie'];
        $movie->trailer     = $data['trailer'];
        $movie->time_movie  = $data['time_movie'];
        $movie->resolution  = $data['resolution'];
        $movie->subtitle    = $data['subtitle'];
        $movie->slug        = $data['slug'];
        $movie->hotmovie    = $data['hotmovie'];
        $movie->description = $data['description'];
        $movie->status      = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->country_id  = $data['country_id'];
        $movie->genre_id    = $data['genre_id'];
        $movie->updated_at  = Carbon::now('Asia/Ho_Chi_Minh');

        $get_image = $request->file('image');


        if ($get_image) {
            if (file_exists('uploads/movie/' . $movie->image)) {
                unlink('uploads/movie/' . $movie->image);
            } else {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image     = current(explode('.', $get_name_image));
                $new_image      = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/movie', $new_image);
                $movie->image   = $new_image;
            }
        }

        $movie->save();
        return redirect()->route('movie.create')->with('status', 'Cập nhật phim thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $movie = Movie::find($id);
        if (file_exists('uploads/movie/' . $movie->image)) {
            unlink('uploads/movie/' . $movie->image);
        }
        $movie->delete();
        return redirect()->back()->with('status', ' Xóa thành công!');
    }
}
