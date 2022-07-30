<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\AllTrait;
use App\Models\Advertiser;
use Illuminate\Support\Facades\Validator;

class AdvertiserController extends Controller
{
    use AllTrait;
    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:191|string',
                'email' =>'required|max:191|email|unique:advertiser'
            ]);

            if ($validator->fails()) {
                return $this->returnError(422, 'sorry this is an error in validation', 'Error', $validator->errors());
            }
            Advertiser::create([
                'name' => $request->name,
                'email' => $request->email
            ]);

            return $this->returnSuccess(200, 'this Advertiser is added succssfuly' );

        }catch(\Exception $ex){
            return $this->returnError(422, 'sorry this is an error');
        }
    }
    public function update(Request $request, $id){
        try{

            $advertiser = Advertiser::find($id);
            if($advertiser){
                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:191|string',
                    'email' =>'required|max:191|email|unique:advertiser'
                ]);
    
                if ($validator->fails()) {
                    return $this->returnError(422, 'sorry this is an error in validation', 'Error', $validator->errors());
                }
                
            
                $advertiser->update([
                    'name' => $request->name,
                    'email' => $request->email
                ]);

    
                return $this->returnSuccess(200, 'this advertiser is Updated succssfuly' );
    
            }
            return $this->returnError(422, 'sorry this is not exists');

        }catch(\Exception $ex){
            return $this->returnError(422, 'sorry this is an error');
        }
    }
    public function getAllAdvertiseres(){
        try{
            $advertiser = Advertiser::select('*')->paginate(PAGINATION_COUNT);
            
            if($advertiser->count() >= 1){
                return $this->returnData(200, 'there is all advertiseres', $advertiser);
            }
            return $this->returnError(422, 'sorry this is not exists');

        }
        catch(\Exception $ex){
            return $this->returnError(422, 'sorry this is an error');
        }
    }
    public function destroy($id){
        try{
            $advertiser = Advertiser::find($id);
            if($advertiser){
            //delete ads made by this advertiser
            $advertiser->ads()->delete();
            //delete from database
            $advertiser->delete();
            return $this->returnSuccess(200, 'This advertiser successfuly Deleted');

            }
            return $this->returnError(422, 'sorry this id not exists');

        }catch(\Exception $ex){
            return $this->returnError(422, 'sorry this is an error');

        }
    }
}
