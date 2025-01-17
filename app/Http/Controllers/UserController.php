<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(Request $request): JsonResponse {
        
        try {
            User::create([
                'unit_id' => $request->unit_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            return response()->json([
                'message' => 'User created successfully'
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'message' => 'Failed to created user',
                'error' => $th->getMessage()
            ], 400);
        }       
    }

    public function update(Request $request, $userId): JsonResponse {

        try {
            $user = User::find($userId);

            if($user)
            {
                $user->update([
                    'unit_id' => $request->unit_id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password
                ]);
            }

            return response()->json([
                'message' => 'User updated successfully'
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'message' => 'Failed to updated user',
                'error' => $th->getMessage()
            ], 400);
        }       
    }

    public function show(int $userId): JsonResponse {

        try {
            $user = User::find($userId);

            if($user){
                return response()->json([
                    'user' => $user
                ], 200);
            }

            return response()->json([
                'message' => 'User not found',
            ], 404);                

        } catch (\Throwable $th) {

            return response()->json([
                'message' => 'Failed to show user',
            ], 400);
        }       
    }

    public function destroy(int $userId): JsonResponse {

        try {
            $user = User::find($userId);

            if($user){
                $user->delete();

                return response()->json([
                    'user' => 'User deleted successfully'
                ], 200);
            }

            return response()->json([
                'message' => 'User not found',
            ], 404);                

        } catch (\Throwable $th) {

            return response()->json([
                'message' => 'Failed to delete user',
            ], 400);
        }       
    }
}
