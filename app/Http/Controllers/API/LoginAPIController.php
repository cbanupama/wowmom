<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginAPIController extends Controller
{
    public function Login(Request $request)
    {
        $user = User::create($request->all());
//        $googleAuthCode = $request->input( 'googleAuthCode' );
//        $accessTokenResponse= Socialite::driver('google')->getAccessTokenResponse($googleAuthCode);
//        $accessToken=$accessTokenResponse["access_token"];
//        $expiresIn=$accessTokenResponse["expires_in"];
//        $idToken=$accessTokenResponse["id_token"];
//        $refreshToken=isset($accessTokenResponse["refresh_token"])?$accessTokenResponse["refresh_token"]:"";
//        $tokenType=$accessTokenResponse["token_type"];
//        $user = Socialite::driver('google')->userFromToken($accessToken);

        return $user;
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $gUser = Socialite::driver('google')->stateless()->user();
        $this->validateAndLogin($gUser);

        return redirect()->to('/home');
    }

    public function loginWithAPI(Request $request)
    {
        $access_token = Socialite::driver('google')->getAccessTokenResponse($request->get('token'));
        $gUser = Socialite::driver('google')->userFromToken($access_token['access_token']);
        $this->validateAndLogin($gUser);
    }

    public function validateAndLogin($gUser)
    {
        $existUser = User::where('email',$gUser->email)->first();

        if($existUser) {
            // existing user
            // use existing user credentials and login via passport
            $user = User::findOrFail($existUser->id);
        }
        else {
            // if it's a new user
            $user = new User();
            $user->name = $gUser->name;
            $user->email = $gUser->email;
            $user->password = bcrypt(str_random(12));
            $user->save();
            // use existing user credentials and login via passport
        }

        return $user;
    }
}
