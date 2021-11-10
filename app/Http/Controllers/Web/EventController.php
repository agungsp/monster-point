<?php

namespace App\Http\Controllers\Web;

use App\Helpers\FunctionHelper;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class EventController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $events = Event::all();
            return response()->json($events);
        }
        return view('pages.event.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.event.editor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'code' => ['required', 'unique:events,Kode', 'string', 'max:10'],
            'name' => ['required', 'string', 'max:250'],
            'note' => ['string', 'max:250'],
            'formula' => ['required', 'string', 'max:500'],
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $event = Event::create([
            'IdMerchant' => 1,
            'Kode' => $request->code,
            'Event' => $request->name,
            'Keterangan' => $request->note,
            'Formula' => FunctionHelper::formatFormula($request->formula)
        ]);

        return response([
            'message' => 'The event has been created',
            'url' => route('events.edit', $event)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('pages.event.editor', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(),[
            'code' => ['required', 'unique:events,Kode,'.$event->Id, 'string', 'max:10'],
            'name' => ['required', 'string', 'max:250'],
            'note' => ['string', 'max:250'],
            'formula' => ['required', 'string', 'max:500'],
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        Event::where('Id', $event->Id)->update([
            'Kode' => $request->code,
            'Event' => $request->name,
            'Keterangan' => $request->note,
            'Formula' => FunctionHelper::formatFormula($request->formula)
        ]);
        $event->refresh();

        return response([
            'message' => 'The event has been updated',
            'url' => route('events.edit', $event)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response([
            'message' => 'The event has been deleted',
        ]);
    }
}
