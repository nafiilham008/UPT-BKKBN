<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Image;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Path for user avatar file.
     *
     * @var string
     */
    // protected $avatarPath = '/uploads/images/avatars/';

    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'avatar' => ['nullable', 'image', 'max:1024']
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['avatar']) && $input['avatar']->isValid()) {
            // Hapus file gambar lama
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $filename = $input['avatar']->hashName();
            $path = $input['avatar']->storeAs('images/profile/user', $filename, 'public');
        } else {
            $path = $user->avatar;
        }

        $user->forceFill([
            'avatar' => $path,
        ])->save();
        
        if ($input['email'] !== $user->email && $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
