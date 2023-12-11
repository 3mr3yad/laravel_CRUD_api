<?php

namespace App\Http\Controllers;

use App\Models\Muser;
use Illuminate\Http\Request;

class MuserController extends Controller
{
    public function get_all_user()
    {
        $users = Muser::get();
        return response()->json($users);
    }

    public function create_user(Request $request)
    {
        $newUser = Muser::create($request->all());
        return response()->json($newUser);
    }

    public function delete_user($id)
    {
        $newUser = Muser::find($id);
        $newUser->delete();
        $res = [
            "message" => "User deleted",
            "statues" => 200,
            "data" => $newUser,
        ];
        return response()->json($res);
    }

    // public function update_user(Request $request, $id)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         // Add other validation rules
    //     ]);

    //     $updateUser = Muser::findOrFail($id);
    //     $updateUser->update([
    //         'name' => $request->input('name'),
    //         // Update other attributes
    //     ]);
    //     $res = [
    //         "message" => "User deleted",
    //         "statues" => 200,
    //         "data" => $updateUser,
    //     ];
    //     return response()->json($res);
    // }

    public function update_user(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                // Add other validation rules
            ]);

            $updateUser = Muser::findOrFail($id);

            $updateUser->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                // Update other attributes
            ]);

            $res = [
                "message" => "User updated successfully",
                "status" => 200,
                "data" => $updateUser,
            ];

            return response()->json($res);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            // User not found
            $res = [
                "message" => "User not found",
                "status" => 404,
            ];

            return response()->json($res, 404);
        }
    }
}
