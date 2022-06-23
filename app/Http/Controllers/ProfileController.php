<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller {

    /**
     * Показує список всіх профілей
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $profiles = auth()->user()->profiles()->paginate(4);
        return view('user.profile.index', compact('profiles'));
    }

    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function profile() {
        // TODO: потрібна якась перевірка
        $profile = self::findOrFail();
        return response()->json($profile);
    }

    /**
     * Показує форму для створення профілю
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('user.profile.create');
    }

    /**
     * Зберігає новий профіль в бд
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $this->validate($request, [
            'user_id' => 'in:' . auth()->user()->id,
            'title' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
        ]);

        $profile = Profile::create($request->all());
        return redirect()
            ->route('user.profile.show', ['profile' => $profile->id])
            ->with('success', 'Новий профіль успішно створений');
    }

    /**
     * Показує інформацію про профіль
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile) {
        if ($profile->user_id !== auth()->user()->id) {
            abort(404);
        }
        return view('user.profile.show', compact('profile'));
    }

    /**
     * Показує форму дл яредагування профілю
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile) {
        if ($profile->user_id !== auth()->user()->id) {
            abort(404);
        }
        return view('user.profile.edit', compact('profile'));
    }

    /**
     * Обновляє профіль (БД)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile) {

        $this->validate($request, [
            'user_id' => 'in:' . auth()->user()->id,
            'title' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
        ]);

        $profile->update($request->all());
        return redirect()
            ->route('user.profile.show', ['profile' => $profile->id])
            ->with('success', 'Профіль успішно змінено');
    }

    /**
     * Удаляє профіль ( БД)
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile) {
        if ($profile->user_id !== auth()->user()->id) {
            abort(404);
        }
        $profile->delete();
        return redirect()
            ->route('user.profile.index')
            ->with('success', 'Профіль було успішно видалено');
    }
}
