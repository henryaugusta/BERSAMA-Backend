<?php

namespace App\Http\Controllers;

use App\Helper\RazkyFeb;
use App\Models\EatEvent;
use App\Models\EatEventDocumentation;
use App\Models\Expense;
use App\Models\News;
use App\Models\User;
use App\Models\UserEventMapping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EatEventController extends Controller
{
    public function viewManage()
    {
        $datas = EatEvent::all();
        return view('eat_event.manage')->with(compact('datas'));
    }

    public function viewMyActivity(Request $request)
    {
        $matchThese = ['user_id' => Auth::id(), 'deleted_at' => null];

        if ($request->type == "not_taken") {
            $matchThese = ['user_id' => Auth::id(), 'deleted_at' => null, 'taken_at' => null];
        }

        $datas = UserEventMapping::where($matchThese)->get();

        if ($request->type == "taken") {
            $matchThese = ['user_id' => Auth::id(), 'deleted_at' => null];
            $datas = UserEventMapping::where($matchThese)->where('taken_at','<>',null)->get();
            // TODO : FIX LOGIC
        }

        $type = $request->type;

        $kompekt = compact('datas','type');
        return view('eat_event.manage_act')
            ->with($kompekt);
    }

    public function viewDetail($id, Request $request)
    {
        $data = EatEvent::findOrFail($id);
        $participants = null;
        $expenses = Expense::where('event_id','=',$id)->get();
        $docs = EatEventDocumentation::where('event_id','=',$id)->get();

        $type = "";
        if ($request->tab != "")
            $type = $request->tab;

        if ($request->tab == "participant") {
            $matchThese = ['deleted_at' => null, 'event_id' => $id];
            $participants = UserEventMapping::where($matchThese)->get();
        }

        $kompekt = compact('data',
            'type',
            'expenses',
            'docs',
            'participants');

        return view('eat_event.detail')
            ->with($kompekt);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cari()
    {
        $datas = EatEvent::where('status', '<>', '0')->get();
        return view('eat_event.find')->with(compact('datas'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('eat_event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $obj = new EatEvent();
        return $this->proceedUpdateOrCreate($obj, $request);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = EatEvent::findOrFail($id);
        return view('eat_event.edit')->with(compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $obj = EatEvent::findOrFail($id);
        return $this->proceedUpdateOrCreate($obj, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Request $request
     */
    public function SaveData($data, Request $request)
    {
        if ($data->save()) {
            if ($request->is('api/*'))
                return RazkyFeb::responseSuccessWithData(
                    200, 1, 200,
                    "Berhasil Menyimpan Data",
                    "Success",
                    $data,
                );

            return back()->with(["success" => "Berhasil Menyimpan Data"]);
        } else {
            if ($request->is('api/*'))
                return RazkyFeb::responseErrorWithData(
                    400, 3, 400,
                    "Gagal Menyimpan Data",
                    "Failed",
                    ""
                );
            return back()->with(["errors" => "Gagal Menyimpan Data"]);
        }
    }

    private function proceedUpdateOrCreate($obj, Request $request)
    {
        $obj->name = $request->name;
        $obj->location = $request->location;
        $obj->created_by = Auth::id();
        $obj->offline_quotas = $request->offline_quotas;
        $obj->online_quotas = $request->online_quotas;
        $obj->food = $request->food;
        $obj->time_start = $request->time_start;
        $obj->time_end = $request->time_end;
        $obj->lat = $request->lat;
        $obj->long = $request->long;
        $obj->pic_contact = $request->pic_contact;
        $obj->pic_name = $request->pic_name;
        $obj->status = $request->status;
        $obj->m_description = $request->m_description;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            $file_path = public_path() . $obj->photo;
            RazkyFeb::removeFile($file_path);

            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/eat_event/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
            $obj->photo = $photoPath;
        }

        return $this->SaveData($obj, $request);
    }
}
