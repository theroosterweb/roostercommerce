<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index(Request $request){
        $brands = Brand::latest();
        
        if(!empty($request->get('keyboard'))){
            $brands = $brands->where('name','like','%'.$request->get('keyboard').'%');
        }

        $brands = $brands->paginate(10);

        return view('admin.brands.list', compact('brands'));
    }
    
    public function create() {
        return view('admin.brands.create');
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:brands',
        ]);

        if($validator->passes()){

            $brand = new Brand();

            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();


            session()->flash('success', 'Tu brand ha sido añadido con exito.');

            return response()->json([
                'stauts' => true,
                'message' => 'Tu brand ha sido añadido con exito.',
            ]);
        

        }else{
            return response()->json([
                'stastus'=> false,
                'errors'=>$validator->errors()
            ]);
        }
    }

    public function edit($brandId, Request $request){
        $brand = Brand::find($brandId);
        
        if(empty($brand)){
            return redirect()->route('admin.brands.index');
        }

        return view('admin.brands.edit', compact('brand'));
    }

    public function update($brandId, Request $request){
        
        $brand = Brand::find($brandId);
        
        if(empty($catebrandgory)){
            response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'El brand no ha sido encontrado',
            ]);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$brand->id.',id',
        ]);

        if($validator->passes()){

            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();

            session()->flash('success', 'Tu brand ha sido editado con exito.');

            return response()->json([
                'stauts' => true,
                'message' => 'Su brand ha sido editado con exito.',
                'redirect' => route('admin.brands.index') // Inserisci qui l'URL della rotta verso cui vuoi reindirizzare l'utente
            ]);
        

        }else{
            return response()->json([
                'stastus'=> false,
                'errors'=>$validator->errors()
            ]);
        }
    }

    public function destroy($brandId){
        $brand = Brand::find($brandId);

        if(empty($brand)){
            session()->flash('error','Brand no encontrado!');
            return response()->json([
                'stastus'=> true,
                'message'=> "Brand no encontrado!",
            ]);
            //return redirect()->route('admin.categories.index');
        }
        
        $brand->delete();

        session()->flash('success','Brand eliminado con exito');

        return response()->json([
            'stastus'=> true,
            'message'=> "Brand eliminado con exito!",
        ]);
    }
}
