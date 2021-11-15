<?php

namespace App\Http\Controllers;

use App\Helper\RazkyFeb;
use App\Models\EatEvent;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpensesController extends Controller
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
        $datas = Expense::all();
        return view('expense.manage')->with(compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $events = EatEvent::all();
        return view('expense.create')->with(compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $obj = new Expense();
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
        $data = Expense::findOrFail($id);
        return view('expense.edit')->with(compact('data', 'events'));
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
        $obj = Expense::findOrFail($id);
        return $this->proceedUpdateOrCreate($obj, $request, $request->redirectTo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy($id, Request $request)
    {
        $obj = Expense::findOrFail($id);
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
        $obj->amount = $request->amount;
        $obj->event_id = $request->event_id;
        $obj->category = $request->category;
        $obj->description = $request->description;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            $file_path = public_path() . $obj->photo;
            RazkyFeb::removeFile($file_path);

            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = time() . '.' . $extension;

            $savePath = "/web_files/expenses/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
            $obj->photo = $photoPath;
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
