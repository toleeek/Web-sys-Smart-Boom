<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {
    /**
     * Показує список всіх користувачів
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = User::paginate(5);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Показує форму для користувача
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Оновлює данні користувача в бд
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, User $user) {

        $this->validator($request->all(), $user->id)->validate();

        if ($request->change_password) {
            $request->merge(['password' => Hash::make($request->password)]);
            $user->update($request->all());
        } else {
            $user->update($request->except('password'));
        }

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Данні користувача успішно оновлені');
    }

    /**
     *
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    private function validator(array $data, int $id) {
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',



                'unique:users,email,'.$id.',id',
            ],
        ];
        if (isset($data['change_password'])) {
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }
        return Validator::make($data, $rules);
    }
}
