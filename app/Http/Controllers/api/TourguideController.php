<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreTourguideRequest;
use App\Http\Requests\UpdateTourguideRequest;
use App\Http\Resources\TourguideDataResource;
use App\Http\Resources\TourguideResource;
use App\Models\Tourguide;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TourguideController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show', 'store', 'search']);
    }
    public function index()
    {
        try {
            $tourguide = TourguideResource::collection(Tourguide::all());
            return response()->json(['data' => $tourguide], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while retrieving the data.'], 500);
        }
    }

    public function store(StoreTourguideRequest $request)
    {
      
        $data = $request->all();

        try {

            $user = User::create([
                'type' => 'tourguide',
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password']
            ]);
            $data['id'] = $user->id;
            $tourist = Tourguide::create($data);
            return response()->json(['data' => new TourguideDataResource($tourist)], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while creating the tourist', 'error'=> $th], 500);
        }

    }

    public function show(Tourguide $tourguide)
    {
        return response()->json(new TourguideDataResource($tourguide), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTourguideRequest $request, Tourguide $tourguide)
    {
        try {
            if (Gate::allows('is-tourguide')) {
                $currentUser = auth()->user();
                $oldAvatar = $tourguide->avatar;
                $oldImage = $tourguide->profile_img;
                if ($tourguide->id === $currentUser->id) {
                    $user = User::findOrfail($currentUser->id);
                    $data = $request->all();
                    if (isset($data['name'])) {
                        $user->update(['name' => $data['name']]);
                    }
                    $tourguide->update(['phone' => $data['phone'], 'bio'=> $data['bio'], 'description'=> $data['description'], 'day_price'=> $data['day_price']]);

                    if ($request->hasFile('avatar')) {
                        $file = $request->file('avatar');
                        $avatarname = time() . $file->getClientOriginalName();
                        $file->move(public_path('img'), $avatarname);
                        $tourguide->update(['avatar' => $avatarname]);
                        if (!Str::startsWith($oldAvatar, 'http')) {
                            $avatarPath = public_path('img/' . $oldAvatar);
                            if (file_exists($avatarPath)) {
                                unlink($avatarPath);
                                
                            }
                        }
                    }

                    if ($request->hasFile('profile_img')) {
                        $file = $request->file('profile_img');
                        $imagename = time() . $file->getClientOriginalName();
                        $file->move(public_path('img'), $imagename);
                        $tourguide->update(['profile_img' => $imagename]);
                        if (!Str::startsWith($oldImage, 'http')) {
                            $imagePath = public_path('img/' . $oldImage);
                            if (file_exists($imagePath)) {
                                unlink($imagePath);
                                
                            }
                        }
                    }
                    return response()->json(new TourguideDataResource($tourguide), 200);

                }
            } else {
                return response()->json(['message' => 'You are not allowed to update this tourguide.'], 403);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => 'An error occurred while updating the tourguide'], 500);
        }

        return response()->json(['message' => 'Tourguide updated successfully', 'data' => new TourguideDataResource($tourguide)], 200);
    }

    public function destroy(Tourguide $tourguide)
    {
        try {
            if (Gate::allows('is-admin')) {
                $user = auth()->user();
                if ($tourguide->id === $user->id) {

                    $tourguide->delete();
                    return response()->json([
                        'message' => 'Tourguide deleted successfully.'
                    ], 200);
                } 
            } else {
                return response()->json(['message' => 'You are not allowed to delete this tourguide.'], 403);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'An error occurred while deleting the tourguide'], 500);
        }
    }

   public function search(Request $request){
    try {
        $name = $request->name;
        $city = $request->city;
        $language = $request->language;

        $tourguides = TourguideResource::collection(
            Tourguide::whereHas('user', function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            })->whereHas('areas', function ($query) use ($city) {
                $query->where('area', 'like', '%' . $city . '%'); 
            })->whereHas('languages', function ($query) use ($language) {
                $query->where('language', 'like', '%' . $language . '%'); 
            })->get()
        );

        return response()->json(['data' => $tourguides], 200);
    } catch (\Throwable $th) {
        \Log::error($th);
        return response()->json(['message' => $th], 500);
    }
}
}
