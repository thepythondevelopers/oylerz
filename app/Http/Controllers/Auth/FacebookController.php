<?php


namespace App\Http\Controllers\Auth;


use App\User;
use App\Http\Controllers\Controller;
use Socialite;
use Exception;
use Auth;
use Request;
use Illuminate\Support\Facades\Hash;

class FacebookController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook(Request $request)
    {
        return Socialite::driver('facebook')->redirect();
        /*$fb = $this->facebookconfigDriver($request);
        return $fb->redirect();*/
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
             
             $finduser = User::where('google_id', $user->id)->first();
     
            if($finduser){
     
                Auth::login($finduser);
    
                return redirect('/');
     
            }else{

                $newUser = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'facebook_id'=> $user->getId(),
                    'role'=> 'user',
                    'password' => Hash::make($user->getId())
                ]);
    
                Auth::login($newUser);
     
                 return redirect('/')->with('success', 'Successfully Registered as User.');
             }   



            /*$create['name'] = $user->getName();
            $create['email'] = $user->getEmail();
            $create['facebook_id'] = $user->getId();


            $userModel = new User;
            $createdUser = $userModel->addNew($create);
            Auth::login($createdUser->id);


            return redirect()->route('home');*/


        } catch (Exception $e) {


            return redirect('auth/facebook');


        }
    }
}