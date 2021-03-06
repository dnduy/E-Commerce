<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $image = Banner::all();
        return view('admin.banner.index', ['image' => $image]);
    }


    public function uploadMultiple(Request $request)
    {
      
        if ($request->hasFile('file')) {
            // Upload path
            $destinationPath = 'upload/';

            // Get file extension
            $extension = $request->file('file')->getClientOriginalExtension();

            // Valid extensions
            $validextensions = array("jpeg", "jpg", "png",);

            // Check extension
            if (in_array(strtolower($extension), $validextensions)) {

                // Rename file 
                $fileName = $request->file('file')->getClientOriginalName() . time() . '.' . $extension;
                // Uploading file to given path
                $request->file('file')->move($destinationPath, $fileName);

                $banner = new Banner();
                $banner->image = $fileName;
                $banner->save();

            }
        }

 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = Banner::find($id);
        return view('admin.banner.edit', ['image' => $image]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, $id)
    {
        $image = $this->doUpload($request);
        $id = Banner::find($id)->update(['image' => $image]);
        return response()->json('OK');

    }


    public function doUpload(BannerRequest $request){

        $fileName = "";
        //Ki???m tra file
        if ($request->file('image')->isValid()) {
			// File n??y c?? th???c, b???t ?????u ?????i t??n v?? move
			$fileExtension = $request->file('image')->getClientOriginalExtension(); // L???y . c???a file
			
			// Filename c???c shock ????? kh???i b??? tr??ng
			$fileName = time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . "." . $fileExtension;
						
			// Th?? m???c upload
			$uploadPath = public_path('/upload'); // Th?? m???c upload
			
			// B???t ?????u chuy???n file v??o th?? m???c
			$request->file('image')->move($uploadPath, $fileName);
		}
		else {
        }
        return $fileName;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Banner::find($id)->delete();
        return response()->json('OK');
    }
}
