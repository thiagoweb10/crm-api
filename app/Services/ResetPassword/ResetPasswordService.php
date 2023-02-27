<?php

namespace App\Services\ResetPassword;

use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\SendLinkResetPasswordUserJob;
use App\Http\Requests\ResetPassword\UpdateRequest;

class ResetPasswordService {

    public function getLinkResetPassword($request)
    {
        $user = $this->checkLoginData($request);

        if (!is_null($user)) {

            SendLinkResetPasswordUserJob::dispatch($user);
            return 'O link para reset de senha foi enviado para o seu e-mail.';
        }

        return 'Usuário não localizado!';
    }

    public function saveNewPassword(User $user, $request)
    {
        $user->update($request);

        return 'Senha alterada com sucesso!';
    }

    public function checkLoginData($request)
    {
        $user = User::where('email', $request['email'])->first();
        return $user; 
    }

}