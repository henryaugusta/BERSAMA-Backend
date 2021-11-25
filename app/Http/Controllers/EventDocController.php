<?php

namespace App\Http\Controllers;

use App\Helper\RazkyFeb;
use App\Models\EatEvent;
use App\Models\EatEventDocumentation;
use App\Models\Expense;
use Illuminate\Http\Request;

class EventDocController extends Controller
{
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
     * @return \Illuminate\Http\Response
     */
    public function viewManage()
    {
        $datas = EatEventDocumentation::all();
        return view('event_doc.manage')->with(compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $events = EatEvent::all();
        return view('event_doc.create')->with(compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $obj = new EatEventDocumentation();
        return $this->proceedUpdateOrCreate($obj, $request, $request->redirectTo);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $events = EatEvent::all();
        $data = EatEventDocumentation::findOrFail($id);
        return view('event_doc.edit')->with(compact('data', 'events'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $obj = EatEventDocumentation::findOrFail($id);
        return $this->proceedUpdateOrCreate($obj, $request, $request->redirectTo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy($id, Request $request)
    {
        $obj = EatEventDocumentation::findOrFail($id);
        $file_path = public_path() . $obj->file;
        RazkyFeb::removeFile($file_path);
        if ($obj->delete()) {
            if ($request->is('api/*'))
                return RazkyFeb::responseSuccessWithData(
                    200, 1, 200,
                    "Berhasil Menghapus Data",
                    "Success",
                    $obj,
                );

            return back()->with(["success" => "Berhasil Menghapus Data"]);
        } else {
            if ($request->is('api/*'))
                return RazkyFeb::responseErrorWithData(
                    400, 3, 400,
                    "Gagal Menyimpan Data",
                    "Failed",
                    $obj
                );
            return back()->with(["errors" => "Gagal Menghapus Data"]);
        }
    }

    private function proceedUpdateOrCreate($obj, Request $request, $redirectTo)
    {
        $obj->event_id = $request->event_id;
        $obj->type = $request->type;
        $obj->description = $request->description;
        $obj->link_vid = $request->link_vid;

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $file_path = public_path() . $obj->file;
            RazkyFeb::removeFile($file_path);

            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/doc/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
            $obj->file = $photoPath;
        }

        if ($obj->save()) {
            if ($request->is('api/*'))
                return RazkyFeb::responseSuccessWithData(
                    200, 1, 200,
                    "Berhasil Menyimpan Data",
                    "Success",
                    $obj,
                );

            return redirect($redirectTo)->with(["success" => "Berhasil Menyimpan Data"]);
        } else {
            if ($request->is('api/*'))
                return RazkyFeb::responseErrorWithData(
                    400, 3, 400,
                    "Gagal Menyimpan Data",
                    "Failed",
                    $obj
                );
            return redirect($redirectTo)->with(["errors" => "Gagal Menyimpan Data"]);
        }

    }

}
