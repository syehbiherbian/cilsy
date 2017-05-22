<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use DB;

use Validator;
use Redirect;
use DateTime;
use Helper;
use Auth;

use App\lessons;
use App\categories;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = DB::table('lessons')
        ->leftJoin('categories', 'lessons.category_id', '=', 'categories.id')
        ->select('lessons.*','categories.title as category_title')
        ->get();
        return view('admin.lesson.index',[
            'lessons' => $lessons,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = DB::table('categories')->get();
        return view('admin.lesson.create',[
            'cat' => $cat,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = array(
          'title'   => 'required|unique:lessons',
          'cat'     => 'required',
          'desc'    => 'required',
          'slug'    => 'required',
          'image'   => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $now          = new DateTime();
            $title        = Input::get('title');
            $categori_id  = Input::get('cat');
            $desc         = Input::get('desc');
            $slug         = Input::get('slug');
            $image        = Input::get('image');
            $tiket_upload_status=1;
            if (!is_dir("assets/filepraktek/")) {
                $newforder=mkdir("assets/filepraktek");
            }
            $file = Input::file('file');
            if ($file !==null) {

             $fileName   = $file->getClientOriginalName();
             $file->move("assets/filepraktek", $fileName);
            //  $fileName   = $file->getClientOriginalName();
            //  $request->file('file')->move("assets/file/ticket/".$fileName);
             $store->file_praktek = $fileName;
            $store->save();
            }
            $insert = DB::table('lessons')->insert([
              'enable'      => 1,
              'title'       => $title,
              'category_id' => $categori_id,
              'image'       => $image,
              'description' => $desc,
              'slug'        => $slug,
              'created_at'  => $now,
              'updated_at'  => $now
            ]);
            if ($file !==null) {
             foreach ($file as $key =>  $tiket)
               {
                 $fileName   = $tiket->getClientOriginalName();
                 $tiket->move("assets/filepraktek", $fileName);

                  $insert= DB::table('file_praktek')->insert([
                   'lesson_id'=>$lesson_id,
                   'file_status'=>$file_status,
                   'tiket_name'=>$tiketname[$key],
                   'file_praktek'=>$fileName,
                   'created_at' => $now,
                   ]);
               }
            }
            $tiketname = Input::get('tiketname');
          // $size = $file->getSize();
          // var_dump($size) ;exit;
         // Disini proses mendapatkan judul dan memindahkan letak gambar ke folder image

           if ($file !==null) {
             foreach ($file as $key =>  $tiket)
               {
                 $fileName   = $tiket->getClientOriginalName();
                 $tiket->move("assets/filepraktek", $fileName);

                  $insert= DB::table('file_praktek')->insert([
                   'lesson_id'=>$lesson_id,
                   'file_status'=>$file_status,
                   'tiket_name'=>$tiketname[$key],
                   'file_praktek'=>$fileName,
                   'created_at' => $now,
                   ]);
               }
           }
            if($insert){
                 return redirect('system/lessons')->with('success','New Data Succesfully created');

            }else{
                  return Redirect()->back()->with('error','Sorry something is error !');
            }

        }
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
        $lessons    = lessons::find($id);
        $categories = categories::where('enable','=','1')->get();
        return view('admin.lesson.edit',[
            'categories'    => $categories,
            'lessons'       => $lessons
        ]);
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
        $rules = array(
            'title'         => 'required|unique:lessons,title,'.$id,
            'category_id'   => 'required',
            'description'   => 'required',
            'slug'          => 'required',
            'image'         => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            // store
            $store = lessons::find($id);
            $store->enable      = Input::get('enable');
            $store->title       = Input::get('title');
            $store->category_id = Input::get('category_id');
            $store->image       = Input::get('image');
            $store->description = Input::get('description');
            $store->slug        = Input::get('slug');
            $store->updated_at  = new DateTime();
            $store->save();

            // redirect
            return redirect('system/lessons')->with('success','Data successfully updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = lessons::find($id);
        $delete->delete();

        return redirect()->back()->with('success','Data successfully deleted');
    }

}
