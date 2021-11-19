<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LogHelper {
    public static function indexLogApi(Request $request, $token, $event, $id, $value){
        try {
            $exec = DB::select('SET NOCOUNT ON; EXEC dbo.sp_ExecEvent @token = ?, @idmember = ?, @event = ?, @value = ?', [
                $token,
                $id,
                $event,
                $value
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong!'], 400);
        }
        return response()->json($exec);
    }
}
