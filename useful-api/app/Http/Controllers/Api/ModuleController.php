<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Module;
use App\Models\User_module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function modules(Request $request)
    {
        //
        $user_id = Auth::user()->id;
        // $modules = User_module::where(['user_id' => auth('sanctum')->user()->id])->get();
        $modules = User_module::where('user_id', $user_id)
            ->where('active', 1)
            ->with('module')
            ->get();
        return response()->json([
            'modules' => $modules,
        ], 200);
    }

    public function activate(Request $request, $id)
    {
        //
        $user_id = Auth::user()->id;
        $active = true;
        $module = Module::find($id);
        if (!$module) {
            return response()->json(['error' => 'Module not found'], 404);
        }
        $module = User_module::updateOrCreate([
            'user_id' => $user_id,
            'module_id' => $id,
            'active' => $active
        ]);
        return response()->json([
            'message' => 'Module activated',
        ], 200);
    }

    public function deactivate(Request $request, $id)
    {
        //
        $module = Module::find($id);
        if (!$module) {
            return response()->json(['error' => 'Module not found'], 404);
        }
        $user = Auth::user()->id;
        $active = 0;
        $user = User_module::updateOrCreate([
            'user_id' => $user,
            'module_id' => $id,
            'active' => $active
        ]);
        return response()->json([
            'message' => 'Module deactivated',
        ], 200);
    }
}
