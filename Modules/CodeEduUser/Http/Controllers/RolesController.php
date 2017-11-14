<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Http\Requests\RoleRequest;
use CodeEduUser\Repositories\RolesRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RolesController extends Controller
{

    private $repository;

    /**
     * RolesController constructor.
     * @param $repository
     */
    public function __construct(RolesRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $roles = $this->repository->orderBy('id')->paginate(5);
        return view('codeeduuser::roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('codeeduuser::roles.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(RoleRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));
        $request->session()->flash('message', 'Papel cadastrado com sucesso!');
        return redirect()->to($url);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        $role = $this->repository->find($id);
        return view('codeeduuser::roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     * @param RoleRequest|Request $request
     * @param $id
     * @return Response
     */
    public function update(RoleRequest $request, $id)
    {
        $data = $request->except(['name']);
        $this->repository->update($data, $id);
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));
        $request->session()->flash('message', 'Papel alterado com sucesso!');
        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        \Session::flash('message', 'Papel excluído com sucesso!');
        return redirect()->to(\URL::previous());
    }
}
