<?php

namespace App\Http\Controllers\AdminControllers\AdminControllersSub;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\KoleksiMuseum;
use App\Models\Museum;

class NewCollectionController extends Controller
{
    public $museum;
    public $imageMuseum;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ajax.only')->only('getImage');
        $this->museum = new Museum;//museum e model
        $this->imageMuseum = new KoleksiMuseum;//museum collection image model
    }
    //
    public function index()
    {
        $museum =$this->museum->get();
        return view('admin.adminsub.insertcollection')
        ->with('museum',$museum);

    }

    public function savecollection(Request $request)
    {


        $request->validate([
            'museum'=>['required','exists:museum,id'],
            'name'=>['required'],
            'image' => ['required','image','mimes:jpeg,png,jpg']
        ]);

        $imageText = $request->image->getClientOriginalName();

        if($request->image){
            $image_img = $request->image;
            $imageCode = Str::slug($request->museum,'-').'-'.time().'.'.$image_img->extension();
            $image_img->move(public_path('collections'),$imageCode);
        }

        $this->imageMuseum->create([
            'nama_gambar' => $request->name,
            'gambar' => $imageCode,
            'museum_id' => $request->museum,
            "created_at" =>  date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('message','pembuatan berhasil!');
    }

    public function edit()
    {

        $museum =$this->museum->get();
        return view('admin.adminsub.updatecollection')->with('museum',$museum);
    }

    public function update(Request $request)
    {
        //dd($request);
        $request->validate([
            'museum' => ['required','exists:museum,id'],
            'collection' =>['required','exists:koleksi_museum,id'],
            'image' => ['image','mimes:jpeg,png,jpg']
        ]);

        $image = $this->imageMuseum->find($request->collection);

        if($request->image){
            $image_img = $request->image;
            $imageCode = Str::slug($request->museum,'-').'-'.time().'.'.$image_img->extension();
            $image_img->move(public_path('collections'),$imageCode);
        }

        //name
        if(!empty($request->name))
        {
          $image->nama_gambar = $request->name;
        }

        //image
        if(!empty($request->image))
        {
          $image->gambar = $imageCode;
        }
        $image->save();

        return redirect()->back()->with('message','pembaharuan behasil!');
    }

    public function show()
    {
        $museum =$this->museum->get();
        return view('admin.adminsub.deletecollection')->with('museum',$museum);
    }

    public function destroy(Request $request)
    {
        $collection = $this->imageMuseum->find($request->collection);
        $collection->delete();

        return redirect()->back()->with('message','penghapusan berhasil!');
    }

    public function getCollection(Request $request)
    {
        $museumId = $request->museum_id;
        $imageJSON = $this->imageMuseum->where('museum_id',$museumId)->get();
        return response()->json($imageJSON);

    }

    public function getImage(Request $request)
    {
        $collectionId = $request->collection_id;
        $dataJSON = $this->imageMuseum->where('id',$collectionId)->get();
        $dataimg = $dataJSON->pluck('gambar');
        $img = $dataimg[0];
        $url = asset('collections/'.$img);
        /*$dataname = $imageJSON->pluck('image_name');
        $name = $dataname[0];
        dd($url);*/
        $name =  $dataJSON->pluck('nama_gambar');
        return response()->json([0 =>['url' => $url,'name' => $name,]]);
    }
}
