<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Http\Requests\UserSettingRequest;
use CodeEduUser\Repositories\UserRepository;
use Illuminate\Http\Request;
use CodeEduUser\Http\Requests\UserRequest;


class UserSettingsController extends Controller
{

    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function edit()
    {
        $user = \Auth::user();
        return view('codeeduuser::user-settings.setting', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserSettingRequest $request)
    {
        $user = \Auth::user();
        $this->repository->update($request->all(), $user->id);
        $request->session()->flash('message', 'Usuário alterado com sucesso!');
        return redirect()->route('codeeduuser.user_settings.edit');
    }


}
