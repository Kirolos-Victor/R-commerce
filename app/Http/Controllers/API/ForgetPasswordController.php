<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    public function sendLink(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator()->make($request->all(), [
                'email' => 'required|email|exists:users,email',

            ], [
                'email.exists' => 'There is no account linked to this email'
            ]);

            if ($validator->fails()) {
                return responseJson(301, 'failed', $validator->errors());

            }

            $response = [
                'status' => 200,
                'message' => 'We have e-mailed your password reset link!',
                'data' => null
            ];

            //close channel and send request and run mail task in the background
           // closeChannelAndFireRequest($response);

            $token = Str::random(64);

            DB::table('password_resets')->insert(
                ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
            );

            Mail::send('emails.password-reset', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password Notification');
            });
            DB::commit();
            return responseJson(200, 'We have e-mailed your password reset link!');
        } catch (\Exception $error) {
            DB::rollBack();
            dd($error);
        }

    }

    public function resetPasswordForm($token)
    {
        $email = DB::table('password_resets')->where(['token' => $token])->select('email')->first();
        return view('frontend.reset-password.index', ['token' => $token, 'email' => $email]);

    }

}
