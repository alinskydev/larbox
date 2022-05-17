<?php

namespace Modules\User\Services;

use App\Services\ActiveService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Modules\User\Mail\UserResetPasswordMail;
use Illuminate\Support\Facades\Hash;
use Modules\Region\Models\RegionCity;

class UserService extends ActiveService
{
    public function availableCities()
    {
        $cities = $this->model->cities->pluck('id')->toArray();

        if (!$cities) {
            $regions = $this->model->regions->pluck('id')->toArray();
            $cities = RegionCity::query()->whereIn('region_id', $regions)->get()->pluck('id')->toArray();
        }

        return $cities;
    }

    public function sendResetPasswordCode()
    {
        $reset_password_code = Str::random(8);

        $this->model->reset_password_code = $reset_password_code;
        $this->model->saveQuietly();

        Mail::to([$this->model->email])->send(new UserResetPasswordMail($reset_password_code));
    }

    public function resetPassword(string $password)
    {
        $this->model->password = Hash::make($password);
        $this->model->reset_password_code = null;
        $this->model->saveQuietly();
    }
}
