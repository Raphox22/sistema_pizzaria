<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 * @author Vinícius Sarmento
 * @link https://github.com/ViniciusSCS
 * @date 2024-08-23 21:48:54
 * @copyright UniEVANGÉLICA
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::select('id', 'name', 'email')->paginate('2');

        return [
            'status' => 200,
            'menssagem' => 'Usuários encontrados!!',
            'user' => $user
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $request)
    {
        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return [
            'status' => 200,
            'menssagem' => 'Usuário cadastrado com sucesso!!',
            'user' => $user
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->all();
        try {
            $user = User::findOrFail($id);
            $user->update($data);

        } catch (\Exception $e) {
            return [
                'status' => 400,
                'menssagem' => 'Erro ao atualizar usuário!!',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $user = User::findOrFail($id);
            $user->delete();

        } catch (\Exception $e) {
            return [
                'status' => 400,
                'menssagem' => 'Erro ao deletar usuário!!',
                'error' => $e->getMessage()
            ];
        }
    }
}
