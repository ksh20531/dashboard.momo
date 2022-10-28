<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Log::info("DashboardController::index");

        return view('dashboard.index');
    }

    public function list(Request $request){
        \Log::info("DashboardController::list");

        $search_str = $request->get('search_str');

        $dashboards = Dashboard::where('deleted',0);


        if($search_str != null){
            $dashboards->where('title','like','%'.$search_str.'%');
        }
        $dashboards = $dashboards->paginate(10);

        return view('dashboard.list',[
            'dashboards' => $dashboards,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \Log::info("DashboardController::create");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Log::info("DashboardController::store");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        \Log::info("DashboardController::show");
        \Log::info("id: ".$id);
        
        $data = [];
        if($id == 0){
            $data['id'] = 0;
            $data['title'] = null;
            $data['content'] = null;
        }else{
            $board_content = Dashboard::where('id',$id)->first();

            $data['id'] = $board_content->id;
            $data['title'] = $board_content->title;
            $data['content'] = $board_content->content;
        }

        return view('dashboard.show_board',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        \Log::info("DashboardController::edit");
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
        \Log::info("DashboardController::update");

        if($id == 'submit'){
            $submit_id = $request->get('id');
            $submit_title = $request->get("title");
            $submit_content = $request->get("content");

            if($submit_id == 0){
                $board_content = new Dashboard;
            }else{
                $board_content = Dashboard::where('id',$submit_id)->first();
            }
            $board_content->title = $submit_title;
            $board_content->content = $submit_content;
            $board_content->save();

            return $board_content->id;

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
        \Log::info("DashboardController::destroy");
    }
}
