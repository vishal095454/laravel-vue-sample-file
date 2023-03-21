<?php

namespace App\Http\Controllers;

use App\Http\Requests\PresentationRequest;
use App\Models\Presentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PresentationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presentation = Presentation::selectRaw('presentations.id,client_name,client_type,first_name,last_name,presentations.created_at,presentations.updated_at')
            ->where('user_id',auth()->id())
            ->leftJoin('users', 'users.id','=', 'presentations.user_id')
            ->when(request('client_type'),function ($q) {
                return $q->where('client_type', request('client_type'));
            })
            ->when(request('search'),function ($q) {
                return $q->where(function($q) {
                    $search = request('search').'%';
                    return $q->where('client_name','like', $search)
                        ->orWhere('first_name','like', $search)
                        ->orWhere('last_name','like', $search);
                });
            })
            ->orderByRaw(request('sortBy'))
            ->get();
        return response()->json($presentation);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PresentationRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = auth()->id();
            
            $presentation = Presentation::create($data);
    
            return response()->json($presentation, 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                "message" => $th->getMessage()
            ], 400);
        }
    }

    /**
     * restore to delated data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore(Presentation $presentation)
    {
        try {         
            $presentation->restore();
            return response()->json($presentation, 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                "message" => $th->getMessage()
            ], 400);
        }
    }

    /**
     * create duplicate row from existing row
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function replicate(Presentation $presentation)
    {
        try {
            $copy = $presentation->replicate();
            $copy->created_at = now();
            $copy->save();

            return response()->json($copy, 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                "message" => $th->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function show(Presentation $presentation)
    {
        return response()->json($presentation, 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function update(PresentationRequest $request, Presentation $presentation)
    {
        try {
            $data = $request->validated();

            $presentation->fill($data);
            $presentation->save();
    
            return response()->json($presentation, 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                "message" => $th->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presentation  $presentation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presentation $presentation)
    {
        try {
            $msg = $presentation->client_name.' has been removed';
            $presentation->delete();
    
            return response()->json(['message'=>$msg], 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                "message" => $th->getMessage()
            ], 400);
        }
    }
}
