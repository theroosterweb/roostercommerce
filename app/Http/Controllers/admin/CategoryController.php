<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;    
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
{
    public function index(Request $request){
        $categories = Category::latest();
        
        if(!empty($request->get('keyboard'))){
            $categories = $categories->where('name','like','%'.$request->get('keyboard').'%');
        }

        $categories = $categories->paginate(10);

        return view('admin.categories.list', compact('categories'));
    }

    public function create(){
        return view('admin.categories.create');
    }
    
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:categories',
        ]);

        if($validator->passes()){

            $category = new Category();

            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->save();

            if(!empty($request->image_id)){
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $newImageName = $category->id.'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/category/imagen_'.$newImageName;
                File::copy($sPath,$dPath);

                $category->image = $newImageName;
                $category->save();

            }

            session()->flash('success', 'Tu categoria ha sido añadida.');

            return response()->json([
                'stauts' => true,
                'message' => 'Su categoria ha sido añadida.',
                'redirect' => route('admin.categories.index') // Inserisci qui l'URL della rotta verso cui vuoi reindirizzare l'utente
            ]);
        

        }else{
            return response()->json([
                'stastus'=> false,
                'errors'=>$validator->errors()
            ]);
        }
    }
    
    public function edit($categoryId, Request $request){
        $category = Category::find($categoryId);
        
        if(empty($category)){
            return redirect()->route('admin.categories.index');
        }

        return view('admin.categories.edit', compact('category'));
    }
    
    public function update($categoryId, Request $request){
        
        $category = Category::find($categoryId);
        
        if(empty($category)){
            response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'La categoria no ha sido encontrada',
            ]);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$category->id.',id',
        ]);

        if($validator->passes()){

            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->save();

            $oldImg = $category->image;

            if(!empty($request->image_id)){
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $newImageName = $category->id.'-'.time().''.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/category/imagen_'.$newImageName;
                File::copy($sPath,$dPath);

                $category->image = $newImageName;
                $category->save();

                //delete images
                File::delete(public_path().'/uploads/category/imagen_'.$oldImg);

            }

            session()->flash('success', 'Tu categoria ha sido editada con exito.');

            return response()->json([
                'stauts' => true,
                'message' => 'Su categoria ha sido editada con exito.',
                'redirect' => route('admin.categories.index') // Inserisci qui l'URL della rotta verso cui vuoi reindirizzare l'utente
            ]);
        

        }else{
            return response()->json([
                'stastus'=> false,
                'errors'=>$validator->errors()
            ]);
        }
    }
    
    public function destroy($categoryId){
        $category = Category::find($categoryId);

        if(empty($category)){
            session()->flash('error','Categoria no encontrada!');
            return response()->json([
                'stastus'=> true,
                'message'=> "Categoria no encontrada!",
            ]);
            //return redirect()->route('admin.categories.index');
        }
        
         //delete images
        File::delete(public_path().'/uploads/category/imagen_'.$category->image);

        $category->delete();

        session()->flash('success','Categoria eliminada con exito');

        return response()->json([
            'stastus'=> true,
            'message'=> "Categoria eliminada con exito!",
        ]);
    }
}
