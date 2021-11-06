<?php

namespace App\Http\Controllers;

use App\Helper\RazkyFeb;
use App\Models\Donasi;
use App\Models\DonationAccount;
use App\Models\News;
use App\Models\PaymentMerchant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DonasiController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     */
    public function viewIkutDonasi()
    {
        $merchants = PaymentMerchant::where('status', '=', '1')->get();
        $donation_accounts = DonationAccount::where('status', '=', '1')->get();

        $jenisDonasi = Session::get("donation-step-type");
        return view('donasi.ikut_donasi.view')->with(compact('merchants',
            'donation_accounts',
            'jenisDonasi'));
    }

    public function myDonation()
    {
        $datas = Donasi::where('user_id', '=', Auth::id())->orderBy('id', 'desc')->get();


        $donationPending = 0;
        $donationDone = 0;

        foreach ($datas as $key) {

            if (is_numeric($key->amount)) {
                if ($key->is_verified == "1" && $key->verified_amount!="") {
                    $donationDone += $key->verified_amount;
                }
                if ($key->is_verified == "0") {
                    $donationPending += $key->amount;
                }
            }
        }

        return view('donasi.my_donation')
            ->with(compact(
                'datas',
                'donationPending',
                'donationDone'));
    }

    public function all()
    {
        $datas = Donasi::orderBy('id', 'desc')->get();

        $donationPending = 0;
        $donationDone = 0;

        foreach ($datas as $key) {

            if (is_numeric($key->amount)) {
                if ($key->is_verified == "1" && $key->verified_amount!="") {
                    $donationDone += $key->verified_amount;
                }
                if ($key->is_verified == "0") {
                    $donationPending += $key->amount;
                }
            }
        }

        return view('donasi.my_donation')
            ->with(compact(
                'datas',
                'donationPending',
                'donationDone'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {


        $data = new Donasi();
        $data->user_id = Auth::id();
        $data->accounts_id = $request->account_id;
        $data->is_verified = 0; //
        $data->amount = $request->amount; //
        $data->verified_amount = null; //
        $data->verified_at = null; //
        $data->desc = ""; //
        $data->verified_by = null; //
        if ($request->show_as != "") {
            $data->show_as = $request->show_as; //
        }
        $data->message = $request->donation_message; //


        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension(); // you can also use file name
            $fileName = Auth::id() . '_' . time() . '.' . $extension;

            $savePath = "/web_files/donasi/";
            $savePathDB = "$savePath$fileName";
            $path = public_path() . "$savePath";
            $file->move($path, $fileName);

            $photoPath = $savePathDB;
            $data->photo = $photoPath;
        }

        return $this->SaveData($data, $request);
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
     */
    public function edit($id)
    {
        $data = Donasi::findOrFail($id);
        $donation_accounts = DonationAccount::where('status', '=', '1')->get();

        return view('donasi.edit')
            ->with(compact(
                'data', 'donation_accounts'));
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
        $data = Donasi::findOrFail($id);
        $data->desc = $request->desc;
        $data->is_verified = $request->is_verified;
        $data->verified_amount = $request->amount_verified;
        $data->verified_by = Auth::id();
        $data->verified_at = Carbon::now();

        return $this->SaveData($data, $request);
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
     * @param News $data
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
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

            return back()->with(["success" => "Donasi Anda Berhasil Diinput, Silakan lihat status pada menu donasi saya"]);
        } else {
            if ($request->is('api/*'))
                return RazkyFeb::responseErrorWithData(
                    400, 3, 400,
                    "Berhasil Menginput Data",
                    "Success",
                    ""
                );
            return back()->with(["errors" => "Gagal Menyimpan Data"]);
        }
    }
}
