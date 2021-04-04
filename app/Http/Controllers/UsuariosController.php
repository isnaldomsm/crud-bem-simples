<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the usuarios.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $usuariosQuery = Usuarios::query();
        $usuariosQuery->where('title', 'like', '%'.$request->get('q').'%');
        $usuariosQuery->orderBy('title');
        $usuarios = $usuariosQuery->paginate(25);

        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new usuarios.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new Usuarios);

        return view('usuarios.create');
    }

    /**
     * Store a newly created usuarios in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Usuarios);

        $newUsuarios = $request->validate([
            'title'       => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $newUsuarios['creator_id'] = auth()->id();

        $usuarios = Usuarios::create($newUsuarios);

        return redirect()->route('usuarios.show', $usuarios);
    }

    /**
     * Display the specified usuarios.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\View\View
     */
    public function show(Usuarios $usuarios)
    {
        return view('usuarios.show', compact('usuarios'));
    }

    /**
     * Show the form for editing the specified usuarios.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\View\View
     */
    public function edit(Usuarios $usuarios)
    {
        $this->authorize('update', $usuarios);

        return view('usuarios.edit', compact('usuarios'));
    }

    /**
     * Update the specified usuarios in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Usuarios $usuarios)
    {
        $this->authorize('update', $usuarios);

        $usuariosData = $request->validate([
            'title'       => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $usuarios->update($usuariosData);

        return redirect()->route('usuarios.show', $usuarios);
    }

    /**
     * Remove the specified usuarios from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Usuarios $usuarios)
    {
        $this->authorize('delete', $usuarios);

        $request->validate(['usuarios_id' => 'required']);

        if ($request->get('usuarios_id') == $usuarios->id && $usuarios->delete()) {
            return redirect()->route('usuarios.index');
        }

        return back();
    }
}
