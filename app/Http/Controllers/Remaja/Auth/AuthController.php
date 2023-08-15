<?php

namespace App\Http\Controllers\Remaja\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendVerificationCodeEmail;
use App\Mail\VerificationCodeEmail;
use App\Models\Remaja\DetailUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        if (Auth::check()) {
            return redirect()->intended('/remaja');
        }

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            Auth::login($existingUser, true);
        } else {
            $newUser = new User();
            $newUser->name = $user->getName();
            $newUser->email = $user->getEmail();
            $newUser->password = bcrypt(Str::random(16));
            // $newUser->avatar = $user->getAvatar();
            $newUser->email_verified_at = now();

            $avatarUrl = $user->getAvatar();
            if ($avatarUrl) {
                $filename = Str::random(16) . '.jpg';
                $path = 'images/profile/user/' . $filename;
                Storage::disk('public')->put($path, file_get_contents($avatarUrl));
                $newUser->avatar = $path;
            } else {
                $newUser->avatar = null;
            }

            $newUser->save();

            $newUser->assignRole('User Remaja');

            Auth::login($newUser, true);
        }

        return redirect()->intended('/remaja');
    }


    public function indexLogin()
    {
        return view('remaja.auth-user.login');
    }

    public function login(Request $request)
    {
        // Validasi input dari form login
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            if ($user->email_verified_at === null) {
                $verificationCode = $this->generateVerificationCode();
                $verificationCodeEncrypt = bcrypt($verificationCode);
                $verificationCodeUrlSafe = base64_encode($verificationCodeEncrypt);
                $user->verification_code = $verificationCodeUrlSafe;
                $user->save();

                // $job = new SendVerificationCodeEmail($user, $verificationCode);
                // dispatch($job);
                Mail::to($user->email)->send(new VerificationCodeEmail($verificationCode));


                return redirect()->route('remaja.verification', ['code' => $verificationCodeUrlSafe])->with('error', 'Please confirm your account!');
            } elseif ($user && $user->hasRole('User Remaja') && Auth::attempt($credentials) && $user->email_verified_at !== null) {
                return redirect()->intended('/remaja');
            } else {
                return redirect()->route('remaja.login')->with('error', 'Invalid email or password');
            }
        }
    }

    public function indexRegister()
    {
        return view('remaja.auth-user.register');
    }

    public function register(Request $request)
    {
        // Validasi input dari form registrasi

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'confirm-password' => 'required|same:password',
            'birthdate' => 'required',
            'gender' => 'required|in:man,woman',
        ], [
            'email.unique' => 'The email has already been taken.',
            'confirm-password.same' => 'The password confirmation does not match.',
            'gender.in' => 'The gender must be either "man" or "woman".',
        ]);


        // Simpan pengguna baru
        $newUser = new User();
        $newUser->name = $request->input('name');
        $newUser->email = $request->input('email');
        $newUser->password = bcrypt($request->input('password'));
        // Generate Code

        $verificationCode = $this->generateVerificationCode();
        $verificationCodeEncrypt = bcrypt($verificationCode);
        $verificationCodeUrlSafe = base64_encode($verificationCodeEncrypt);
        $newUser->verification_code = $verificationCodeUrlSafe;

        $newUser->save();

        $detailUser = new DetailUser();
        $detailUser->birthdate = $request->input('birthdate');
        $detailUser->gender = $request->input('gender');

        $newUser->detailUser()->save($detailUser->fill(['user_id' => $newUser->id]));

        $newUser->assignRole('User Remaja');
        // dd($verificationCodeUrlSafe); 

        // Mengirim email verifikasi
        // $job = new SendVerificationCodeEmail($newUser, $verificationCode);
        // dispatch($job);
        // Mail::to($newUser->email)->send(new VerificationCodeMail($newUser, $verificationCode));
        Mail::to($newUser->email)->send(new VerificationCodeEmail($verificationCode));

        return redirect()->route('remaja.verification', ['code' => $verificationCodeUrlSafe])->with('success', 'Verification code has been sent to your email. Please check!.');
    }

    function generateVerificationCode()
    {
        // Generate a random verification code
        $verificationCode = rand(100000, 999999);

        return $verificationCode;
    }


    public function indexVerification($code)
    {
        $user = User::where('verification_code', $code)->first();
        if ($user) {
            return view('remaja.auth-user.code-verification', compact('user'));
        } else {
            return redirect()->back()->with('error', 'Invalid proccess');
        }
    }

    public function verificationProcess($code, Request $request)
    {
        $request->validate([
            'verification_code' => 'required',
        ]);

        $user = User::where('verification_code', $code)->first();
        $userCode = base64_decode($user->verification_code);

        if ($user && Hash::check($request->input('verification_code'), $userCode)) {
            $user->email_verified_at = now();
            $user->verification_code = null;
            $user->save();

            Auth::login($user);

            return redirect()->route('user.profile')->with('success', 'Verification account successful!');
        }

        return redirect()->back()->with('error', 'Invalid verification code.');
    }


    public function resendVerification($id)
    {
        $user = User::findOrFail($id);

        $verificationCode = $this->generateVerificationCode();
        $verificationCodeEncrypt = bcrypt($verificationCode);
        $verificationCodeUrlSafe = base64_encode($verificationCodeEncrypt);

        $user->verification_code = $verificationCodeUrlSafe;
        $user->save();

        // Mengirim email verifikasi
        // $job = new SendVerificationCodeEmail($user, $verificationCode);
        // dispatch($job);
        Mail::to($user->email)->send(new VerificationCodeEmail($verificationCode));


        return redirect()->route('remaja.verification', ['code' => $verificationCodeUrlSafe])->with('success', 'Verification code has been sent to your email. Please check!.');
    }

}
