<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Tag(
 *      name="Authentication",
 * )
 */
class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     tags={"Authentication"},
     *     path="/register",
     *     summary="Register a new user",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="jhon@gmail.com"),
     *             @OA\Property(property="password", type="string", example="secretpassword"),
     *             @OA\Property(property="password_confirmation", type="string", example="secretpassword"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Created",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="token", type="string", example="0|WYgnFtfJU6oMR8Q852lFPjtyjRSuSHjolb98q9kx"),
     *              @OA\Property(property="user", ref="#/components/schemas/User")
     *          )
     *     ),
     *     @OA\Response(response="422", description="Unprocessable Content"),
     * )
     */
    function register(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('token')->plainTextToken;

        return response([
            'token' => $token,
            'user' => $user
        ], Response::HTTP_CREATED);
    }

    /**
     * @OA\Post(
     *     tags={"Authentication"},
     *     path="/login",
     *     summary="Login a new user",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="string", format="email", example="jhon@gmail.com"),
     *             @OA\Property(property="password", type="string", example="secretpassword"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Ok",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="token", type="string", example="0|WYgnFtfJU6oMR8Q852lFPjtyjRSuSHjolb98q9kx"),
     *              @OA\Property(property="user", ref="#/components/schemas/User")
     *          )
     *     ),
     *     @OA\Response(response="401", description="Unauthorized"),
     * )
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = $request->user();
            $token = $user->createToken('token')->plainTextToken;

            return response(['token' => $token, 'user' => $user], Response::HTTP_OK);
        }

        return response(['errors' => $request->password], Response::HTTP_UNAUTHORIZED);
        return response(['errors' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
    }
}
