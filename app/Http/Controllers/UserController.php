<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/**
 * @OA\Tag(
 *      name="users"
 * )
 */
class UserController extends Controller
{
    /**
     *  @OA\Get(
     *     path="/user",
     *     tags={"users"},
     *     summary="Get the current user",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response="200",
     *         description="successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             ref="#/components/schemas/User"
     *         )
     *     ),
     * )
     */
    public function show(Request $request)
    {
        return $request->user();
    }

    /**
     * @OA\Put(
     *      path="/users",
     *      tags={"users"},
     *      summary="Update user profile",
     *      security={{"sanctum": {}}},
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="jhon@gmail.com"),
     *             @OA\Property(property="phone_number", type="string", example="081234567890"),
     *             @OA\Property(property="address", type="string", example="AV. 1, No. 2, 3rd Floor"),
     *             @OA\Property(property="password", type="string", example="secretpassword"),
     *             @OA\Property(property="password_confirmation", type="string", example="secretpassword"),
     *         )
     *     ),
     *      @OA\Response(
     *          response="200",
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="user", ref="#/components/schemas/User")
     *          )
     *      ),
     *     @OA\Response(response="401", description="Unauthorized"),
     *     @OA\Response(response="422", description="Unprocessable Content"),
     * )
     */
    public function update(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($request->user()->id)],
            'phone_number' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = $request->user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->customer->update([
            'phone_number' => $request->phone_number,
            'address' => $request->address
        ]);

        return response($user, Response::HTTP_OK);
    }
}
