<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\AllTrait;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use AllTrait;
    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:191|string',
            ]);

            if ($validator->fails()) {
                return $this->returnError(422, 'sorry this is an error in validation', 'Error', $validator->errors());
            }
            Category::create([
                'name' => $request->name,
            ]);

            return $this->returnSuccess(200, 'this Category is added succssfuly' );

        }catch(\Exception $ex){
            return $this->returnError(422, 'sorry this is an error');
        }
    }
    public function update(Request $request, $id){
        try{

            $category = Category::find($id);
            if($category){
                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:191|string',
                ]);
    
                if ($validator->fails()) {
                    return $this->returnError(422, 'sorry this is an error in validation', 'Error', $validator->errors());
                }
                
            
                $category->update([
                    'name' => $request->name,
                ]);

    
                return $this->returnSuccess(200, 'this category is Updated succssfuly' );
    
            }
            return $this->returnError(422, 'sorry this is not exists');

        }catch(\Exception $ex){
            return $this->returnError(422, 'sorry this is an error');
        }
    }
    public function getAllCategories(){
        try{
            $category = Category::select('*')->paginate(PAGINATION_COUNT);
            
            if($category->count() >= 1){
                return $this->returnData(200, 'there is all categories', $category);
            }
            return $this->returnError(422, 'sorry this is not exists');

        }
        catch(\Exception $ex){
            return $this->returnError(422, 'sorry this is an error');
        }
    }
    public function destroy($id){
        try{
            $category = Category::find($id);
            if($category){
            //delete ads made down this category
            $category->ads()->delete();
            //delete from database
            $category->delete();
            return $this->returnSuccess(200, 'This Category successfuly Deleted');

            }
            return $this->returnError(422, 'sorry this id not exists');

        }catch(\Exception $ex){
            return $this->returnError(422, 'sorry this is an error');

        }
    }
}
