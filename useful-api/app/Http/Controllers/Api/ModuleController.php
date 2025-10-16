<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\module;
use App\Models\User_module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Container\Attributes\Auth;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function modules(Request $request)
    {
        //
        $user_id = auth('sanctum')->user()->id;
        // $modules = User_module::where(['user_id' => auth('sanctum')->user()->id])->get();
        $modules = User_module::where(['active' => true])->get();
        return response()->json([
            'modules' => $modules,
        ], 200);
    }

    public function activate(Request $request , $id)
    {
        //
        $user = auth('sanctum')->user();
        $active = true;
        $module = Module::create([
            'user_id' => $user,
            'module_id' => $id,
            'active' => $active
        ]);
        $module->save();
        return response()->json([
            'message' => 'Module activated',
        ], 200);
    }

    public function deactivate(Request $request ,$id)
    {
        //

        $user = auth('sanctum')->user()->id;
        $active = false;
        $user = Module::create([
            'user_id' => $user,
            'module_id' => $id,
            'active' => $active
        ]);
        return response()->json([
            'message' => 'Module deactivated',
        ], 200);
    }
}
