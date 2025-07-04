<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Support\Facades\Storage;

class AcnooServiceController extends Controller
{
    use HasUploader;

    public function index()
    {
        $services = Service::with(['category:id,name', 'user:id,name,image'])
                    ->withCount('reviews')
                    ->withAvg('reviews', 'rating')
                    ->when(request('search'), function($q) {
                        $q->where('discount_type', 'like', '%'.request('search').'%')
                        ->orWhere('title', 'like', '%'.request('search').'%')
                        ->orWhere('discount', 'like', '%'.request('search').'%')
                        ->orWhere('duration', 'like', '%'.request('search').'%')
                        ->orWhere('description', 'like', '%'.request('search').'%')
                        ->orWhere('features', 'like', '%'.request('search').'%')
                        ->orWhere('category_id', 'like', '%'.request('search').'%')
                        ->orWhereHas('category', function($query) {
                            $query->where('name', 'like', '%'.request('search').'%');
                        });
                    })
                    ->when(request('min_price'), function($query) {
                        $query->where('price', '>=', request('min_price'));
                    })
                    ->when(request('max_price'), function($query) {
                        $query->where('price', '<=', request('max_price'));
                    })
                    ->when(request('user_id'), function($q) {
                        $q->where('user_id', request('user_id'));
                    })
                    ->when(request('category_id'), function($q) {
                        $q->where('category_id', request('category_id'));
                    })
                    ->latest()
                    ->paginate(20);

        return response()->json([
            'meassage' => 'Data fetch successfully',
            'data' => $services
        ]);
    }

    public function store(Request $request)
    {   
        $request->validate([
            'price' => 'required|integer',
            'duration' => 'required|string',
            'features*' => 'nullable|string',
            'discount' => 'required|integer',
            'story' => 'required|integer',
            'reels' => 'required|integer',
            'post' => 'required|integer',
            'description' => 'nullable|string',
            'category_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'discount_type' => 'required|string',
            'images*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1048',
        ]);

        $final_price = $request->price;
        if ($request->discount > 0) {
            $final_price = $request->price - $request->discount;
            if ($request->discount_type != 'fixed') {
                $final_price = ($request->price * $request->discount) / 100;
                $final_price = $request->price - $final_price;
            }
        }

        $data = Service::create($request->except('images', 'features') + [
                    'user_id' => auth()->id(),
                    'final_price' => $final_price,
                    'story' => $request->story,
                    'post' => $request->post,
                    'reels' => $request->reels,
                    'features' => $request->features ?? [],
                    'images' => $request->images ? $this->multipleUpload($request, 'images') : NULL,
                ]);

        sendPushNotify(
            'New Service Created',
            'A new service titled "' . $data->title . '" has been created and is now available.',
            $data->user->device_token
        );

        sendNotification($data->id, route('admin.services.index', ['id' => $data->id]), notify_users([$data->user_id]), admin_msg:__('New service created'), influ_msg:__('New service has been created'), );

        return response()->json([
            'message' => 'Service created successfully',
            'data' => $data
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::with('user:id,name,image', 'user.categories:id,name', 'category:id,name')->findOrFail($id);
        $reviews = Review::select('id', 'user_id', 'rating', 'description', 'image', 'created_at')->with('user:id,name,image')->where('service_id', $id)->latest()->paginate();
        $total = $service->reviews()->count();
        $average = $service->reviews()->avg('rating');

        return response()->json([
            'message' => 'Data fetch successfully',
            'data' => [
                'service' => $service,
                'reviews' => $reviews,
                'ratings' => [
                    'total' => $total,
                    'average' => $average,
                ],
            ]
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'price' => 'required|integer',
            'discount_type' => 'required|string',
            'discount' => 'required|integer',
            'status' => 'required|string',
            'duration' => 'required|string',
            'description' => 'nullable|string',
            'features*' => 'nullable|string',
            'images*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1048',
        ]);

        $service = Service::findOrFail($id);

        if ($request->removed_images) {
            $prev_images = array_diff($service->images, $request->removed_images);
            $prev_images = array_values($prev_images);

            foreach ($request->removed_images ?? [] as $image) {
                if (Storage::exists($image)) {
                    Storage::delete($image);
                }
            }
        }

        $images = $prev_images ?? $service->images;

        $final_price = $request->price;
        if ($request->discount > 0) {
            $final_price = $request->price - $request->discount;
            if ($request->discount_type != 'fixed') {
                $final_price = ($request->price * $request->discount) / 100;
            }
        }

        $service->update($request->except('images', 'features') + [
            'final_price' => $final_price,
            'features' => $request->features ?? [],
            'story' => $request->story,
            'post' => $request->post,
            'reels' => $request->reels,
            'images' =>   $images + [
                $request->images ? $this->multipleUpload($request, 'images') : $service->images
            ],
        ]);

        return response()->json([
            'message' => 'Service updated successfully',
            'data' => $service
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $services = Service::findOrFail($id);

        if (!empty($services->images)) {
            foreach ($services->images as $imagePath) {
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }
        }
        $services->delete();

        return response()->json([
            'message' => 'Service deleted successfully',
        ], 200);
    }

    public function status(string $id)
    {
        Service::findOrFail($id)->update([
            'status' => request('status')
        ]);

        return response()->json([
            'message' => 'Status updated successfully',
        ]);
    }
}
