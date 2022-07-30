<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\AllTrait;
use App\Models\Ad;
use Illuminate\Support\Facades\Validator;

class AdsController extends Controller
{
    use AllTrait;
    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:191|string',
                'description' => 'required|string',
                'tags.*' => 'required|string',
                'start_date' => 'required|date',
                'advertiser_id' => 'integer',
                'cat_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return $this->returnError(422, 'sorry this is an error in validation', 'Error', $validator->errors());
            }
            $tag = json_encode($request->tags);
            Ad::create([
                'title' => $request->title,
                'description' => $request->description,
                'tags' => $tag,
                'start_date' => $request->start_date,
                'advertiser_id' => $request->advertiser_id,
                'cat_id' => $request->cat_id
            ]);


            return $this->returnSuccess(200, 'this Ad is added succssfuly' );

        }catch(\Exception $ex){
            return $this->returnError(422, 'sorry this is an error');
        }
    }
    public function update(Request $request, $id){
        try{

            $ads = Ad::find($id);
            if($ads){
                $validator = Validator::make($request->all(), [
                    'title' => 'required|max:191|string',
                    'description' => 'required|string',
                    'tags.*' => 'required|string',
                    'start_date' => 'required|date',
                    'advertiser_id' => 'integer',
                    'cat_id' => 'required|integer'
                ]);
    
                if ($validator->fails()) {
                    return $this->returnError(422, 'sorry this is an error in validation', 'Error', $validator->errors());
                }
                
                $tag = json_encode($request->tags);
                $ads->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'tags' => $tag,
                    'start_date' => $request->start_date,
                    'advertiser_id' => $request->advertiser_id,
                    'cat_id' => $request->cat_id
                ]);

    
                return $this->returnSuccess(200, 'this ad is Updated succssfuly' );
    
            }
            return $this->returnError(422, 'sorry this is not exists');

        }catch(\Exception $ex){
            return $this->returnError(422, 'sorry this is an error');
        }
    }
    public function changestatus($id){
        try{
            $ads = Ad::find($id);
            if($ads){
                if($ads->type == 0){
                    $ads->update([
                        'type' => 1
                    ]);
                    return $this->returnSuccess(200, 'this ad is Updated succssfuly to be paid' );

                }else{
                    $ads->update([
                        'type' => 0
                    ]); 
                    return $this->returnSuccess(200, 'this ad is Updated succssfuly to be free' );

                }
            }
            return $this->returnError(422, 'sorry this is not exists');

        }catch(\Exception $ex){
            return $this->returnError(422, 'sorry this is an error');
        }

    }
    public function getAllAds(){
        try{
            $ads = Ad::select('*')->paginate(PAGINATION_COUNT);
            
            if($ads->count() >= 1){
                return $this->returnData(200, 'there is all ads', $ads);
            }
            return $this->returnError(422, 'sorry this is not exists');

        }
        catch(\Exception $ex){
            return $this->returnError(422, 'sorry this is an error');
        }
    }
    public function destroy($id){
        try{
            $ads = Ad::find($id);
            if($ads){

            //delete from database
            $ads->delete();
            return $this->returnSuccess(200, 'This ad successfuly Deleted');

            }
            return $this->returnError(422, 'sorry this id not exists');

        }catch(\Exception $ex){
            return $this->returnError(422, 'sorry this is an error');

        }
    }
}
