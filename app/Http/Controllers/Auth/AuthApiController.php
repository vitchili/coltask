<?php 
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Cookie;

class AuthApiController extends Controller
{

    /**
     * Autentica o usuário na API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request): mixed
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ],
        [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail não é válido.',
            'password.required' => 'O campo senha é obrigatório.'
        ]);

        if (Auth::attempt($credentials)) {
            $user = User::find(auth()->user()->id);
            $token = $user->createToken('api-token');
            $tokenStr = $token->plainTextToken;
            $tomorrow = new DateTime('tomorrow');

            return response()->json([
                'token' => $tokenStr,
                'id' => $user->id,
                'name' => $user->name,
                'expires_at' => $tomorrow->format('m-d-Y')
            ], 200);
        }

        throw ValidationException::withMessages([
            'email' => "As credenciais estão incorretas.",
        ]);
    }

    /**
     * Return users by params.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function usersFilter(Request $request): mixed
    {

        if ($request->direction_id) {
            $directionId = $request->direction_id;
            $users = User::whereHas('directions', function ($query) use ($directionId) {
                $query->where('id', $directionId);
            })->get(['id', 'name'])->toArray();

        }else{
            $users = User::get(['id', 'name'])->toArray();
        }

        return response()->json($users, 200);

    }

    /**
     * Cria um novo usuário na API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request): mixed
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ],
        [
            'name.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail não é válido.',
            'email.max' => 'O campo e-mail deve ter menos de 255 caracteres.',
            'email.unique' => 'O campo e-mail já está sendo utilizado.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'O campo senha deve ter no mínimo 8 caracteres.'
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['token' => $token], 201);
    }

    /**
     * Faz o logout do usuário autenticado na API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request): mixed
    {
        $request->user()->tokens()->delete();
        Auth::guard('web')->logout();
        return response()->json(['message' => 'Logout efetuado com sucesso.'], 200);
    }

}