<?php
namespace App\Helpers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class MemberHelper {
    public static function indexMember()
    {
        if (request()->ajax()) {
            $members = Member::orderBy('id', 'DESC')->get();
            return response()->json($members);
        }
        return view('pages.member.index');
    }

    public static function createMember()
    {
        return view('pages.member.editor');
    }

    public static function storeMember(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'member_key' => ['required'],
            'member_name' => ['required', 'string', 'max:250'],
            'member_note' => ['string', 'max:250'],
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            Member::create([
                'IdMerhant' => 1,
                'MerchentMemberKey' => 3,
                'Point' => $request->member_key,
                'Nama' => $request->member_name,
                'Keterangan' => $request->member_note,
            ]);
        }
        return response(['msg' => 'The member has been created']);
    }

    public static function editMember(Member $member)
    {
        return view('pages.member.editor', compact('member'));
    }

    public static function updateMember(Request $request, Member $member)
    {
        $validator = Validator::make($request->all(), [
            'member_key' => ['required'],
            'member_name' => ['required', 'string', 'max:250'],
            'member_note' => ['max:250'],
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            Member::where('id', $member->Id)->update([
                'Point' => $request->member_key,
                'Nama' => $request->member_name,
                'Keterangan' => $request->member_note,
            ]);
        }
        return response(['msg' => 'The member has been updated']);
    }

    public static function destroyMember(Member $member)
    {
        Member::where('id', $member->Id)->delete();
        return response(['message' => 'The member has been deleted']);
    }

    public static function getMembers(Request $request)
    {
        $members = Member::where('IdMerhant', $request->id)->orderBy('id', 'DESC')->get();
        return response()->json($members);
    }

}
