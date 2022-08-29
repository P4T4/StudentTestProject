<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StudentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'full_name' => 'required',
                'age' => 'required',
                'carrer' => 'required',
                'active' => 'required'
            ]);

            $exists = Students::where([
                ['full_name', $request->full_name],
                ['carrer', $request->carrer],
                ['active', 1]
            ])->count();

            if ($exists > 0) {
                return response()->json(['error' => ['Usuario ya existe con esa carrera']], 400);
            }

            $student = Students::create([
                'full_name' => $request->full_name,
                'age' => $request->age,
                'carrer' => $request->carrer,
                'active' => $request->active
            ]);

            if ($student->save()) {
                return response()->json(['data' => [
                    'success' => 'Registro almacenado correctamente'
                ]]);
            }

            return response()->json(['error' => 'Problemas al almacenar el registro, contacte al administrador'], 500);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al almacenar: ' . $th->getMessage()], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $this->validate($request, [
                'id' => 'required',
                'full_name' => 'required',
                'age' => 'required',
                'carrer' => 'required',
                'active' => 'required'
            ]);

            $student = Students::find($request->id);

            $student->full_name = $request->full_name;
            $student->age = $request->age;
            $student->carrer = $request->carrer;
            $student->active = $request->active;

            if ($student->save()) {
                return response()->json(['data' => [
                    'success' => 'Registro actualizado correctamente'
                ]]);
            }
            return response()->json(['error' => 'Problemas al almacenar el registro, contacte al administrador'], 500);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al almacenar: ' . $th->getMessage()], 500);
        }
    }

    public function delete(Request $request)
    {
        try {
            $this->validate($request, [
                'id' => 'required'
            ]);
            $student = Students::find($request->id);
            $student->active = 0;
            if ($student->save()) {
                return response()->json(['data' => [
                    'success' => 'Registro inhabilitado correctamente'
                ]]);
            }
            return response()->json(['error' => 'Problemas al inhabilitar el registro, contacte al administrador'], 500);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al inhabilitar: ' . $th->getMessage()], 500);
        }
    }

    public function list()
    {
        try {
            return response()->json(['data' => [
                'students' => Students::all()
            ]]);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al listar: ' . $th->getMessage()], 500);
        }
    }

    public function getOne(Request $request)
    {
        try {
            $this->validate($request, [
                'id' => 'required'
            ]);
            return response()->json(['data' => [
                'student' => Students::find($request->id)
            ]]);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al obtener registro: ' . $th->getMessage()], 500);
        }
    }
}
