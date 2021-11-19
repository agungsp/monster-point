<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $merchants = Merchant::orderBy('id', 'DESC')->get();
            return response()->json($merchants);
        }
        return view('pages.merchant.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.merchant.editor');
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

        if ($validator->fails()) {
            return response($validator->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            Merchant::create([
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
        }
        return response(['msg' => 'The Merchant has been created']);
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
        return view('pages.merchant.editor', compact('merchant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merchant $merchant)
    {
        $validator = Validator::make($request->all(), [
            'merchant_name' => ['required'],
            'merchant_address' => ['required'],
            'merchant_pic' => ['required'],
            'merchant_pic_phone' => ['required'],
            'merchant_pic_email' => ['required'],
            'use_for' => ['required'],
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            $query = Merchant::where('id', $merchant->Id)->update([
                'Nama' => $request->merchant_name,
                'Alamat' => $request->merchant_address,
                'Pic' => $request->merchant_pic,
                'PicTelp' => $request->merchant_pic_phone,
                'Email' => $request->merchant_pic_email,
                'Kebutuhan' => $request->use_for,
            ]);
<<<<<<< HEAD
=======
<<<<<<< HEAD
            return response(['msg' => 'The Merchant has been updated']);
=======
>>>>>>> 712f922688c64f5839c97882e3ed5da374141170
        }

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Merchant Has Been Updated']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
<<<<<<< HEAD
=======
>>>>>>> 3fb7533f219b3e192ee25b2aa50e33454e9c7bbf
>>>>>>> 712f922688c64f5839c97882e3ed5da374141170
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merchant $merchant)
    {
<<<<<<< HEAD
=======
<<<<<<< HEAD
        Merchant::where('id', $merchant->Id)->delete();
        return response(['message' => 'The merchant has been deleted']);
=======
>>>>>>> 712f922688c64f5839c97882e3ed5da374141170
        $query = $merchant->delete();
        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Merchant Has Been Deleted From Databases']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
<<<<<<< HEAD
=======
>>>>>>> 3fb7533f219b3e192ee25b2aa50e33454e9c7bbf
>>>>>>> 712f922688c64f5839c97882e3ed5da374141170
    }
}
