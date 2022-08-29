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
    }

    public function store(Request $request)
    {
        $request->validate([
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
            throw ValidationException::withMessages([
                'full_name' => ['Usuario ya existe con esa carrera'],
            ]);
        }

        $student = Students::create([
            'full_name' => $request->full_name,
            'age' => $request->age,
            'carrer' => $request->carrer,
            'active' => $request->active
        ]);

        if ($student->save()) {
            return redirect('/dashboard');
        }

        throw ValidationException::withMessages([
            'full_name' => ['No fue posible almacenar el usuario, contacte al administrador'],
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
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
            return redirect(RouteServiceProvider::HOME);
        }

        throw ValidationException::withMessages([
            'full_name' => ['No fue posible actualizar el usuario, contacte al administrador'],
        ]);
    }

    public function delete(Request $request)
    {
        $student = Students::find($request->id);
        $student->active = 0;
        if ($student->save()) {
            return redirect(RouteServiceProvider::HOME);
        }
        throw ValidationException::withMessages([
            'full_name' => ['No fue posible inhabilitar el usuario, contacte al administrador'],
        ]);
    }
}
