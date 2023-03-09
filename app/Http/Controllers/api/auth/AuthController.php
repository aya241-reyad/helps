<?php

namespace App\Http\Controllers\api\auth;

use App\Models\Help;
use App\Models\Client;
use App\helpers\helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->helper = new helper();
    }

public function register(Request $request){
 $validator = validator()->make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address'=>'required',
            'longitude' => 'required',
            'attitude' => 'required',
            'password' => 'required|confirmed',
        ]);
        if ($validator->fails()) {
            return $this->helper->ResponseJson(0, $validator->errors()->first(), $validator->errors());
        }
        
        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());
        $token = $client->createToken('APIToken')->accessToken;
        $client->save();
        return $this->helper->ResponseJson(1, 'success', [
            'token' => $token,
            'client' => $client,
        ]);


}

public function login(Request $request){
$validator = validator()->make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
       if ($validator->fails()) {

            return $this->helper->ResponseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $client = Client::where('email', $request->email)->first();
        if ($client) {
            if (Hash::check($request->password, $client->password)) {
                $token = $client->createToken('APIToken')->accessToken;

                return $this->helper->ResponseJson(1, 'success', [
                    'token' => $token,
                    'client' => $client,
                ]);
            } else {
                return $this->helper->ResponseJson(0, 'uncorrect data');
            }
        } else {
            return $this->helper->ResponseJson(0, 'uncorrect data');
        }


}
public function createHelp(Request $request){
$validator = validator()->make($request->all(), [
            'longitude' => 'required',
            'attitude' => 'required',
            'description' => 'required',
        ]);
       if ($validator->fails()) {

            return $this->helper->ResponseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $help = Help::create([
            'longitude' =>$request->longitude,
            'attitude' =>$request->attitude,
            'description'=>$request->description,
            'client_id'=>auth()->user()->id,
        ]);
       $help->save();
        return $this->helper->ResponseJson(1, 'success', [
            'help' => $help,
        ]);


}

public function getHelps(){
$helps=Help::where('client_id',auth()->user()->id)->get();
 return $this->helper->ResponseJson(1, 'success', [
            'help' => $helps,
        ]);
}


}
