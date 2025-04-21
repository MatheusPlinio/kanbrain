<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginSocialRequest;
use App\Repositories\Contracts\User\UserRepositoryInterface;
use Firebase\JWT\ExpiredException;
use Log;

class SocialLoginController extends Controller
{
    public function __construct(protected UserRepositoryInterface $userRepository)
    {
    }
    public function login(LoginSocialRequest $request)
    {
        $data = $request->validated();

        try {
            $user = $this->userRepository->firstOrCreateFromSocial($data);

            $token = $user->createToken('NextAuthToken')->plainTextToken;

            return response()->json([
                'message' => 'Autenticação bem-sucedida',
                'accessToken' => $token,
            ]);
        } catch (ExpiredException $e) {
            Log::error('JWT expirado', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Token expirado'], 401);
        } catch (\Exception $e) {
            Log::error('Erro ao processar o JWT', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Erro ao autenticar'], 500);
        }
    }
}
