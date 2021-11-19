<?php

namespace App\Http\Controllers;

use App\Models\Silder;
use Illuminate\Http\Request;
use App\Traits\StrorageProductImage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class SliderController extends Controller
{
    private $slider;

    public function __construct(Silder $slider)
    {
        $this->slider = $slider;
    }


    public function index()
    {
        $result = $this->slider->paginate(10);
        return view('admin.slider.index', compact('result'));
    }

    public function add()
    {
        return view('admin.slider.add');

    }

    public function store(Request $request)
    {

        $folderName = 'Slider-img';
        $data = [
            'name' => $request->name,
            'description' => $request->description
        ];
        //uploadfile
        if ($request->hasFile('imgslider')) {
            //lay ten file goc
            $file_name = $request->file('imgslider')->getClientOriginalName();
            //noi luu duong dan storage va public\storage
            $path = $request->file('imgslider')->storeAs('public/' . $folderName, $file_name);
            $dataUploadTraits = [
                'file_name' => $file_name,
                'file_path' => Storage::url($path)

            ];
            //gan name_img va url vao data[]
            $data['image_path'] = $dataUploadTraits['file_path'];
            $data['image_name'] = $dataUploadTraits['file_name'];

        } else {
            return null;
        }

        $this->slider::create($data);
        session()->flash('success', 'Add Slider Successfullly');
        return redirect()->route('slider.index');
    }

    //edit Silder
    public function edit($id)
    {
        $data = $this->slider->find($id);
        return view('admin.slider.edit', compact('data'));

    }

    //update
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
        $folderName = 'Slider-img';
        $dataupdate = [
            'name' => $request->name,
            'description' => $request->description
        ];
        //uploadfile
        if ($request->hasFile('imgslider')) {
            //lay ten file goc
            $file_name = $request->file('imgslider')->getClientOriginalName();
            //noi luu duong dan storage va public\storage
            $path = $request->file('imgslider')->storeAs('public/' . $folderName, $file_name);
            $dataUploadTraits = [
                'file_name' => $file_name,
                'file_path' => Storage::url($path)

            ];

            //gan name_img va url vao data[]
            $dataupdate['image_path'] = $dataUploadTraits['file_path'];
            $dataupdate['image_name'] = $dataUploadTraits['file_name'];
        }
            $this->slider->find($id)->update($dataupdate);
            session()->flash('success', 'Update Slider Successfullly');
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error("message:".$exception->getMessage()."--Line" .$exception->getLine());

        }


        return redirect()->route('slider.index');
    }

    //delete slider
    public function destroy($id){

        try {
            $data = $this->slider::find($id);
            $data->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Data deleted successfully!'
            ], 200);
        }catch(\Exception $exception){
            return response()->json([
                'code' => 500,
                'message' => 'Data delete Fail!'
            ], 500);
        }


    }
}





