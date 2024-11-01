<?php

namespace app\controller\api;

use app\model\user\UserModel;
use app\service\JwtService;
use Illuminate\Support\Carbon;
use support\Request;
use support\Response;

class LoginController extends ApiBaseController
{
    public function login(Request $request): Response
    {
        $email    = $request->input('email');
        $password = $request->input('password');
        $captcha  = $request->input('captcha');

        $user = UserModel::query()->where('email', $email)->first();
        if (empty($user) || $user->password !== md5($password)) {
            return $this->fail('邮箱或密码错误');
        }
        $token = JwtService::generateToken([
            'id'    => $user->id,
            'name'  => $user->username,
            'email' => $user->email
        ]);

        return $this->success([
            'id'    => $user->id,
            'name'  => $user->username,
            'email' => $user->email,
            'phone' => $user->phone,
            'token' => $token
        ]);
    }

    public function register(Request $request)
    {
        $email    = $request->input('email');
        $username = $request->input('username', $email);
        $password = $request->input('password');
        $captcha  = $request->input('captcha');
        $loginIp  = $request->getRemoteIp();

        # 校验邮箱是否已存在
        # 校验验证码是否正确
        # 校验密码格式是否正确/强度是否合适

        $md5Pwd = md5($password);
        $user   = UserModel::query()->updateOrCreate(['email' => $email], [
            'username'        => $username,
            'password'        => $md5Pwd,
            'ip'              => $loginIp,
            'last_login_time' => Carbon::now()->toDateTimeString()
        ]);

        $token = JwtService::generateToken([
            'id'    => $user->id,
            'name'  => $user->username,
            'email' => $user->email
        ]);

        return $this->success([
            'id'    => $user->id,
            'name'  => $user->username,
            'email' => $user->email,
            'phone' => $user->phone,
            'token' => $token
        ]);
    }

    public function registerCode(Request $request)
    {
        return $this->success();
    }
}