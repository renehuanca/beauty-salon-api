<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
