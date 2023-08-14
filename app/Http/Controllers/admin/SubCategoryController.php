<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use Illuminate\Support\Facades\File;

class SubCategoryController extends Controller
{
    public function index(Request $request){
        $subCategories = SubCategory::select('sub_categories.*','categories.name as categoryName')->latest('sub_categories.id')->leftJoin('categories','categories.id','sub_categories.category_id');
        
        if(!empty($request->get('keyboard'))){
            $subCategories = $subCategories->where('sub_categories.name','like','%'.$request->get('keyboard').'%');
            $subCategories = $subCategories->orWhere('categories.name','like','%'.$request->get('keyboard').'%');

        }

        $subCategories = $subCategories->paginate(10);

        return view('admin.subcategories.list', compact('subCategories'));
    }

    public function create(){
        $categories = Category::orderBy('name','ASC')->get();
        $data['categories'] = $categories;
        return view('admin.subcategories.create',$data);
    }

    public function store(Request $request){
        
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:sub_categories',
            'categoryfather' => 'required',
            'status' => 'required'
        ]);

        if($validator->passes()){

            $subCategory = new SubCategory();

            $subCategory->name = $request->name;
            $subCategory->slug = $request->slug;
            $subCategory->status = $request->status;
            $subCategory->category_id = $request->categoryfather;
            
            $subCategory->save();

            session()->flash('success','La sub-categoria ha sido creada con exito!');

            return response([
                'status' => true, 
                'message' => 'La sub-categoria ha sido creada con exito!',
             ]);

        }else{

            return response([
               'status' => false,
               'errors' => $validator->errors(), 
            ]);
        }

    }

    public function edit ($subCategoryId, Request $request){

        $subCategory = SubCategory::find($subCategoryId);
        
        if(empty($subCategory)){
            session()->flash('error','Record no encontrado!');
            return redirect()->route('admin.subcategories.index');
        }

        $categories = Category::orderBy('name','ASC')->get();

        $data['categories'] = $categories;
        $data['subCategory'] = $subCategory;

        if(empty($subCategory)){
            return redirect()->route('admin.subcategories.index');
        }

        return view('admin.subcategories.edit', compact('subCategory'), $data);
    }

    public function update($subCategoryId, Request $request){
        
        $subCategory = SubCategory::find($subCategoryId);
        
        if(empty($subCategory)){
            response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'La subcategoria no ha sido encontrada',
            ]);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required',
            'categoryfather' => 'required',
            'status' => 'required'
        ]);


        if($validator->passes()){

            $subCategory->name = $request->name;
            $subCategory->category_id = $request->categoryfather;
            $subCategory->slug = $request->slug;
            $subCategory->status = $request->status;
            $subCategory->save();

            session()->flash('success', 'Tu subcategoria ha sido editada con exito.');

            return response()->json([
                'stauts' => true,
                'message' => 'Su subcategoria ha sido editada con exito.',
                //'redirect' => route('admin.subcategories.index') // Inserisci qui l'URL della rotta verso cui vuoi reindirizzare l'utente
            ]);
        

        }else{
            return response()->json([
                'stastus'=> false,
                'errors'=>$validator->errors()
            ]);
        }
    }

    public function destroy($subCategoryId){
        $subCategory = SubCategory::find($subCategoryId);

        if(empty($subCategory)){
            session()->flash('error','Categoria no encontrada!');
            return response()->json([
                'stastus'=> true,
                'message'=> "Categoria no encontrada!",
            ]);
            //return redirect()->route('admin.categories.index');
        }
        
         //delete images
        File::delete(public_path().'/uploads/category/imagen_'.$subCategory->image);

        $subCategory->delete();

        session()->flash('success','Subcategoria eliminada con exito');

        return response()->json([
            'stastus'=> true,
            'message'=> "Subcategoria eliminada con exito!",
        ]);
    }
}
