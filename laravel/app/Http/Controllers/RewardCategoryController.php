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
use App\reward_category;
class RewardCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $data = reward_category::all();
        return view('admin.reward-category.index',[
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.reward-category.create',[
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
          'slug'      => 'required|unique:reward',
          'name'      => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $now        = new DateTime();
            $enab       = Input::get('enable');
            $name       = Input::get('name');
            $slug       = Input::get('slug');

            if (!empty($enab)) {
              $enable = 1;
            }else {
              $enable = 0;
            }

            $store = new reward_category;
            $store->enable      = $enable;
            $store->name        = $name;
            $store->slug        = $slug;
            $store->created_at  = $now;

            $store->save();

            return redirect('system/reward-category')->with('success','Successfully create data');

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
        $data    = reward_category::find($id);
        return view('admin.reward-category.edit',[
            'data'    => $data,
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
            'name' => 'required',
            'slug'       => 'required|unique:reward,slug,'.$id,
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $now        = new DateTime();
            $enab       = Input::get('enable');
            $name       = Input::get('name');
            $slug       = Input::get('slug');

            if (!empty($enab)) {
              $enable = 1;
            }else {
              $enable = 0;
            }

            // store
            $store = reward_category::find($id);
            $store->enable      = $enable;
            $store->name        =$name;
            $store->slug        = $slug;
            $store->updated_at  = $now;
            $store->save();

            // redirect
            return redirect('system/reward-category')->with('success','Data successfully updated');
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
        $data = reward_category::find($id);
        $data->delete();

        return redirect()->back()->with('success','Data successfully deleted');
    }

}
