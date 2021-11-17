<?php

namespace App\Http\Controllers;

use App\Helper\RazkyFeb;
use App\Models\User;
use App\Models\UserEventMapping;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserEventMappingController extends Controller
{
    public function updateTaken($id,Request $request){
        $obj = UserEventMapping::findOrFail($id);
        $obj->taken_at = Carbon::now();
        return $this->SaveData($obj,$request);
    }


    public function registerToEvent(Request $request)
    {
        $matchThese = ['user_id' => Auth::id(), 'event_id' => $request->event_id];
        $checkQuery =
            UserEventMapping::where($matchThese)->count();

        if ($checkQuery > 0) {
            if ($request->is('api/*'))
                return RazkyFeb::responseErrorWithData(
                    400, 3, 400,
                    "Anda Sudah Mendaftar di Event Ini",
                    "Failed",
                    ""
                );
            return redirect($request->redirectTo)
                ->with(["errors" => "Registrasi Gagal, Anda Sudah Terdaftar di Event Ini Sebelumnya"]);
        }

        $obj = new UserEventMapping();
        $obj->user_id = Auth::id();
        $obj->event_id = $request->event_id;

        if ($obj->save()) {
            if ($request->is('api/*'))
                return RazkyFeb::responseSuccessWithData(
                    200, 1, 200,
                    "Berhasil Mendaftar Makan Gratis",
                    "Success",
                    "",
                );

            return redirect($request->redirectTo)->with(["success" => "Berhasil  Mendaftar Makan Gratis"]);
        } else {
            if ($request->is('api/*'))
                return RazkyFeb::responseErrorWithData(
                    400, 3, 400,
                    "Gagal Mendaftar Makan Gratis",
                    "Failed",
                    ""
                );
            return redirect($request->redirectTo)->with(["errors" => "Gagal Mendaftar Makan Gratis"]);
        }
    }

    public function deleteParticipants($id, Request $request)
    {
        $obj = UserEventMapping::findOrFail($id);
        $obj->deleted_at = Carbon::now();
        $obj->deleted_reason = $request->reason;

        if ($obj->save()) {
            if ($request->is('api/*'))
                return RazkyFeb::responseSuccessWithData(
                    200, 1, 200,
                    "Berhasil Menyimpan Data",
                    "Success",
                    "",
                );

            return redirect($request->redirectTo)->with(["success" => "Berhasil Menyimpan Data"]);
        } else {
            if ($request->is('api/*'))
                return RazkyFeb::responseErrorWithData(
                    400, 3, 400,
                    "Gagal Menyimpan Data",
                    "Failed",
                    ""
                );
            return redirect($request->redirectTo)->with(["errors" => "Gagal Menyimpan Data"]);
        }

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

}
