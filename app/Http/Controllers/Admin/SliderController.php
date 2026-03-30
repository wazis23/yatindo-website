<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of sliders.
     */
    public function index(Request $request)
    {
        $type = $request->type ?? 'home_hero';

        $types = [
            'home_hero',
            'smp_hero',
            'smk_hero',
            'akl_hero',
            'tjkt_hero',
            'te_hero',
            'tkr_hero',
            'tbsm_hero',
            'tab_hero'
        ];

        $sliders = Slider::where('type', $type)
            ->orderBy('order_no')
            ->get();

        return view(
            'admin.sliders.index',
            compact('sliders', 'type', 'types')
        );
    }


    /**
     * Show create form.
     */
    public function create(Request $request)
    {
        $type = $request->type ?? 'home_hero';

        return view(
            'admin.sliders.create',
            compact('type')
        );
    }


    /**
     * Store new slider(s).
     */
    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image'
        ]);

        $type = $request->type;

        $lastOrder = Slider::where('type', $type)
            ->max('order_no') ?? 0;

        foreach ($request->file('images') as $image) {

            $path = $image->store('sliders', 'public');

            Slider::create([
                'title'    => $request->title ?? null,
                'image'    => $path,
                'type'     => $type,
                'order_no' => ++$lastOrder
            ]);
        }

        return redirect()
            ->route('admin.sliders.index', ['type' => $type])
            ->with('success', 'Slider berhasil ditambahkan');
    }


    /**
     * Update order slider.
     */
   public function updateOrder(Request $request)
    {
        foreach ($request->orders as $id => $order) {

            \App\Models\Slider::where('id', $id)
                ->update([
                    'order_no' => $order
                ]);

        }

        return response()->json([
            'success' => true
        ]);
    }


    /**
     * Delete slider.
     */
    public function destroy(Slider $slider)
    {
        $type = $slider->type;

        $slider->delete();

        $sliders = Slider::where('type', $type)
            ->orderBy('order_no')
            ->get();

        foreach ($sliders as $index => $item) {

            $item->update([
                'order_no' => $index + 1
            ]);

        }

        return back();
    }
    
}