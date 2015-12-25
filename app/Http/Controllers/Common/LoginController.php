<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Auth;
use ResponseManager;
use Session;
use App\User;
use Mail;
use Request;
use Hash;
use Config;
use JWT;
use GuzzleHttp;

class LoginController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if (Auth::check()) {
            return view('admin');
        } else {
            return view('login');
        }
    }

    public function logout() {
        Auth::logout();
        Session::flush();
        $message = 'Logout successful';
        return Response()->json(ResponseManager::getResult('', 10, $message));
    }

    public function doLogin() {
        $input = Request::all();

        Auth::attempt(array(
            'email' => $input['email'],
            'password' => $input['password'])
                , true);

        if (Auth::check()) {
            $user = Auth::User()->toArray();
            if (!$user['active']) {
                Auth::logout();
                Session::flush();
                $message = 'Your account suspended. Please contact admin.';
                return Response()->json(ResponseManager::getError('', 10, $message));
            }
            $message = 'Success';
            return Response()->json(ResponseManager::getResult($user, 10, $message));
        } else {
            $message = 'Username or password is incorrect';
            return Response()->json(ResponseManager::getError('', 10, $message));
        }
    }

    public function logginuser() {
        if (Auth::check()) {
            $user = User::find(Auth::User()->id);
            $message = 'Success';
            return Response()->json(ResponseManager::getResult($user, 10, $message));
        } else {
            $message = 'Please login';
            return Response()->json(ResponseManager::getError('', 10, $message));
        }
    }

    public function forgotPassword() {
        $input = Request::all();
        $data['code'] = substr(md5(rand(0, 1000000)), 0, 7);
        $user = User::where('email', $input['email']);
        $exist = $user->count();
        if ($exist == 0) {
            $message = 'Email id is not register with us.';
            return Response()->json(ResponseManager::getError('', 10, $message));
        }
        $update = $user->update($data);
        if ($update) {
            $data['email'] = $input['email'];
            Mail::send('emails.password', $data, function( $message ) use ($data) {
                $message->to($data['email'])->subject('Password Reset!');
            });
            $message = 'Password reset link sent successfully to your email. Please check your mail';
            return Response()->json(ResponseManager::getResult($user, 10, $message));
        } else {
            $message = 'Error in sending email, please try again.';
            return Response()->json(ResponseManager::getError('', 10, $message));
        }
    }

    public function resetPassword() {
        $input = Request::all();
        $code = $input['code'];
        //Chk code exist

        $user = User::where('code', $code);
        $exist = $user->count();
        if ($exist == 0) {
            $message = 'Reset link could be expired, please try again';
            return Response()->json(ResponseManager::getError('', 10, $message));
        }
        $input['code'] = '';
        $input['password'] = Hash::make($input['password']);
        $updateUser = $user->update($input);
        if ($updateUser) {
            $message = 'Your password reset properly, you can log in with your new password';
            return Response()->json(ResponseManager::getResult($user, 10, $message));
        } else {
            $message = 'Problems with the password reset, try again.';
            return Response()->json(ResponseManager::getError('', 10, $message));
        }
    }

    protected function createToken($user) {
        $payload = [
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + (2 * 7 * 24 * 60 * 60)
        ];
        return JWT::encode($payload, Config::get('app.token_secret'));
    }

    public function facebook(Request $request) {
        $accessTokenUrl = 'https://graph.facebook.com/v2.4/oauth/access_token';
        $graphApiUrl = 'https://graph.facebook.com/v2.4/me';
        $input = Request::all();
        $params = [
            'code' => $input['code'],
            'client_id' => $input['clientId'],
            'redirect_uri' => $input['redirectUri'],
            'client_secret' => Config::get('app.facebook_secret')
        ];
        $client = new GuzzleHttp\Client();

        $accessToken = $client->get($accessTokenUrl, ['query' => $params]);
        $testvar = json_decode($accessToken->getBody()->getContents(), true);
        $testvar['fields'] = "id,name,first_name,gender,last_name,email,picture";
        $profile = json_decode($client->get($graphApiUrl, ['query' => $testvar])->getBody()->getContents(), true);
        // Step 3a. If user is already signed in then link accounts.
        $user = User::where('fbid', '=', $profile['id']);

        if ($user->first()) {
            $a = $user->first()->toArray();
            Auth::loginUsingId($a['id']);
            return response()->json(['token' => $this->createToken($user->first())]);
        }
        $user = new User;
        $user->facebook = $profile['id'];
        $user->displayName = $profile['name'];
//            $user->save();

        return response()->json(['token' => $this->createToken($user), 'data' => $profile]);
    }

}
