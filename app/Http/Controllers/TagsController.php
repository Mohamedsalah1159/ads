<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\AllTrait;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;

class TagsController extends Controller
{
    use AllTrait;
    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:191|string',
                'ads_id' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return $this->returnError(422, 'sorry this is an error in validation', 'Error', $validator->errors());
            }
            Tag::create([
                'name' => $request->name,
                'ads_id' => $request->ads_id,
            ]);

            return $this->returnSuccess(200, 'this tag is added succssfuly' );

        }catch(\Exception $ex){
            return $this->returnError(422, 'sorry this is an error');
        }
    }
    public function update(Request $request, $id){
        try{

            $tag = Tag::find($id);
            if($tag){
                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:191',
                    'ads_id' => 'required|integer',
                ]);
    
                if ($validator->fails()) {
                    return $this->returnError(422, 'sorry this is an error in validation', 'Error', $validator->errors());
                }
                
            
                $tag->update([
                    'name' => $request->name,
                    'ads_id' => $request->ads_id,
                ]);

    
                return $this->returnSuccess(200, 'this Tag is Updated succssfuly' );
    
            }
            return $this->returnError(422, 'sorry this is not exists');

        }catch(\Exception $ex){
            return $this->returnError(422, 'sorry this is an error');
        }
    }
    public function getAllTags(){
        try{
            $tags = Tag::select('*')->paginate(PAGINATION_COUNT);
            
            if($tags->count() >= 1){
                return $this->returnData(200, 'there is all Tags', $tags);
            }
            return $this->returnError(422, 'sorry this is not exists');

        }
        catch(\Exception $ex){
            return $this->returnError(422, 'sorry this is an error');
        }
    }
    public function destroy($id){
        try{
            $tag = Tag::find($id);
            if($tag){
      
            //delete from database
            $tag->delete();
            return $this->returnSuccess(200, 'This tag successfuly Deleted');

            }
            return $this->returnError(422, 'sorry this id not exists');

        }catch(\Exception $ex){
            return $this->returnError(422, 'sorry this is an error');

        }
    }
}
