<?php

namespace App\Http\Controllers;

use App\Models\BottomSlider;
use App\Models\Slider;
use App\Models\HomePageFourBanner;
use Illuminate\Http\Request;
use Auth;
use File;
use Image;
use Alert;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->type == 1) {
            $sliders = Slider::OrderBy('serial_number', 'ASC')->get();
            $bottomSlider = BottomSlider::first();
            return view('admin.slider.index', compact('sliders', 'bottomSlider'));
        } else {
            return back();
        }
    }
    public function bottomIndex()
    {
        if (Auth::user()->type == 1) {

            $bottomSlider = BottomSlider::first();
            return view('admin.slider.slider', compact('bottomSlider'));
        } else {
            return back();
        }
    }

    public function home_page_four_banner_show()
    {
        if (Auth::user()->type == 1) {
            $banners = HomePageFourBanner::all();
            return view('admin.home_page_four_banner.index', compact('banners'));
        } else {
            return back();
        }
    }

    public function home_page_four_banner_update(Request $request)
    {

        $validatedData = $request->validate([
            'position' => 'required|integer',
            'image' => 'image',
            'link' => 'nullable',
        ]);

        $banner = HomePageFourBanner::find($request->position);

        if (is_null($banner)) {
            $banner = new HomePageFourBanner;
        }

        // image save
        if ($request->image) {
            if (File::exists('images/slider/' . $banner->image)) {
                File::delete('images/slider/' . $banner->image);
            }
            $image = $request->file('image');
            $img = time() . rand() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/slider/' . $img);
            Image::make($image)->save($location);
            $banner->image = $img;
        }
        if ($request->link != null) {
            $banner->link = $request->link;
        }
        if ($request->title != null) {
            $banner->title = $request->title;
        }
        if ($request->description != null) {
            $banner->description = $request->description;
        }

        $banner->save();

        Alert::toast('Banner has been changed', 'success');
        return redirect()->route('f.banner.show');

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'serial_number' => 'required|integer',
            'image' => 'image',
            'link' => 'nullable',
        ]);

        $slider = new Slider;
        $slider->title = $request->title;
        $slider->serial_number = $request->serial_number;
        $slider->description = $request->description;
        $slider->link = $request->link;

        if ($request->image) {
            if (File::exists('images/slider/' . $slider->image)) {
                File::delete('images/slider/' . $slider->image);
            }
            $image = $request->file('image');
            $img = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/slider/' . $img);
            Image::make($image)->save($location);
            $slider->image = $img;
        }

        $slider->save();

        Alert::toast('New Slider Added Successfully.', 'success');
        return redirect()->route('slider.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::find($id);
        if (!is_null($slider)) {
            return view('admin.slider.edit', compact('slider'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'serial_number' => 'required|integer',
            'image' => 'image',
            'link' => 'nullable',
        ]);

        $slider = Slider::find($id);

        if (!is_null($slider)) {

            $slider->title = $request->title;
            $slider->serial_number = $request->serial_number;
            $slider->description = $request->description;
            $slider->link = $request->link;

            // image save
            if ($request->image) {
                if (File::exists('images/slider/' . $slider->image)) {
                    File::delete('images/slider/' . $slider->image);
                }
                $image = $request->file('image');
                $img = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('images/slider/' . $img);
                Image::make($image)->save($location);
                $slider->image = $img;
            }

            $slider->save();

            Alert::toast('Slide Info has been changed', 'success');
            return redirect()->route('slider.index');
        } else {
            Alert::toast('Something went wrong!', 'error');
            return redirect()->route('slider.index');
        }
    }

    public function destroy(Request $request)
    {
        $slider = Slider::find($request->id);
        $slider->delete();
        Alert::toast('Slide has been deleted', 'success');
        return redirect()->route('slider.index');
    }
    public function bottomSliderUpdate(Request $request)
    {
        // Get the first slider or create one if none exists
        $slider = BottomSlider::firstOrCreate(
            ['id' => 1] // or remove this if ID is auto-increment
        );

        // Update links
        $slider->link = $request->link;
        $slider->m_link = $request->m_link;

        // Desktop image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($slider->image && File::exists(public_path('images/slider/' . $slider->image))) {
                File::delete(public_path('images/slider/' . $slider->image));
            }

            $image = $request->file('image');
            $img = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/slider/' . $img);
            Image::make($image)->save($location);

            $slider->image = $img;
        }

        // Mobile image upload
        if ($request->hasFile('m_image')) {
            // Delete old mobile image
            if ($slider->m_image && File::exists(public_path('images/slider/' . $slider->m_image))) {
                File::delete(public_path('images/slider/' . $slider->m_image));
            }

            $mImage = $request->file('m_image');
            $mImg = time() . '_m.' . $mImage->getClientOriginalExtension();
            $mLocation = public_path('images/slider/' . $mImg);
            Image::make($mImage)->save($mLocation);

            $slider->m_image = $mImg;
        }

        $slider->save();

        Alert::toast('Bottom Slider has been updated', 'success');
        return redirect()->route('slider.bottom.index');
    }


}
