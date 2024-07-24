<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Tag(
 *      name="authentication",
 * )
 */
class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     tags={"authentication"},
     *     path="/register",
     *     summary="Register a new customer user",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="jhon@gmail.com"),
     *             @OA\Property(property="phone_number", type="string", example="081234567890"),
     *             @OA\Property(property="address", type="string", example="AV. 1, No. 2, 3rd Floor"),
     *             @OA\Property(property="password", type="string", example="secretpassword"),
     *             @OA\Property(property="password_confirmation", type="string", example="secretpassword"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Created successfully",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="token", type="string", example="0|WYgnFtfJU6oMR8Q852lFPjtyjRSuSHjolb98q9kx"),
     *              @OA\Property(property="user", type="object",
     *                  @OA\Property(property="name", type="string", example="John Doe"),
     *                  @OA\Property(property="email", type="string", format="email", example="jhon@gmail.com"),
     *                  @OA\Property(property="role", type="string", example="customer"),
     *                  @OA\Property(property="updated_at", type="string", format="date-time", example="2023-11-02T14:03:55.000000Z"),
     *                  @OA\Property(property="created_at", type="string", format="date-time", example="2023-11-02T14:03:55.000000Z"),
     *                  @OA\Property(property="id", type="integer", example=1),
     *              )
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
            'phone_number' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => Role::CUSTOMER
        ]);

        Customer::create([
            'user_id' => $user->id,
            'phone_number' => $request->phone_number,
            'address' => $request->address
        ]);

        $token = $user->createToken('token')->plainTextToken;

        return response(['token' => $token, 'user' => $user], Response::HTTP_CREATED);
    }

    /**
     * @OA\Post(
     *     tags={"authentication"},
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
     *          description="Successfull operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="token", type="string", example="0|WYgnFtfJU6oMR8Q852lFPjtyjRSuSHjolb98q9kx"),
     *              @OA\Property(property="user", ref="#/components/schemas/User")
     *          )
     *     ),
     *     @OA\Response(response="401", description="Unauthorized"),
     * )
     */
    public function login(Request $request): Response
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response(['errors' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        $user = $request->user();
        $token = $user->createToken('token')->plainTextToken;

        return response(['token' => $token, 'user' => $user], Response::HTTP_OK);
    }
}
