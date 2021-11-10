<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class MerchantController extends Controller
{
    public function editorMerchant(Request $request)
    {
        $merchant = Merchant::find($request->merchant_id);
        // dd($merchant);
        return view('pages.merchant.editor', compact('merchant'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.merchant.index');
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

    public function getdataMerchant()
    {
        $merchants = Merchant::orderBy('id', 'DESC')->get();
        return $merchants;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'merchant_name' => ['required'],
            'merchant_address' => ['required'],
            'merchant_pic' => ['required'],
            'merchant_pic_phone' => ['required'],
            'merchant_pic_email' => ['required'],
            'use_for' => ['required'],
        ]);
        // dd($request->merchant_address);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $query = Merchant::create([
                'CreateDate' => now(),
                'Token' => Str::random(25),
                'Nama' => $request->merchant_name,
                'Alamat' => $request->merchant_address,
                'Pic' => $request->merchant_pic,
                'PicTelp' => $request->merchant_pic_phone,
                'Email' => $request->merchant_pic_email,
                'Pass' => '123',
                'Kebutuhan' => $request->use_for,
                'LastUpdate' => now(),
                'Akif' => 1,
                'Validasi' => 1
            ]);

            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'New Merchant has been successfuly saved']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Merchant $merchant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Merchant $merchant)
    {
        // dd($merchant);
        return view('pages.merchant.editor', compact('merchant'));
    }

    // public function editMerchant(Request $request)
    // {
    //     $merchant = Merchant::find($request->id);
    //     // dd($merchant);
    //     return response()->json(['details' => $merchant]);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merchant $merchant)
    {
        // dd($merchant);
        // dd($request->merchant_name);
        $merchant_id = $merchant->Id;
        $validator = Validator::make($request->all(), [
            'merchant_name' => ['required'],
            'merchant_address' => ['required'],
            'merchant_pic' => ['required'],
            'merchant_pic_phone' => ['required'],
            'merchant_pic_email' => ['required'],
            'use_for' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $query = $merchant->where('id', $merchant->Id)->update([
                'Nama' => $request->merchant_name,
                'Alamat' => $request->merchant_address,
                'Pic' => $request->merchant_pic,
                'PicTelp' => $request->merchant_pic_phone,
                'Email' => $request->merchant_pic_email,
                'Kebutuhan' => $request->use_for,
            ]);
            // dd($query);
        }

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Merchant Has Been Updated']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

    }

    public function deleteMerchant(Request $request)
    {
        $merchant_id = $request->merchant_id;
        // dd($merchant_id);
        $query = Merchant::where('Id', $merchant_id)->delete();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Merchant Has Been Deleted From Databases']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }
}
