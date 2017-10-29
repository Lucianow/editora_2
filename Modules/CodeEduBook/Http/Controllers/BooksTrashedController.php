<?php

namespace CodeEduBook\Http\Controllers;

use CodePub\Http\Controllers\Controller;
use CodeEduBook\Repositories\BookRepository;
use Illuminate\Http\Request;

class BooksTrashedController extends Controller
{

    private $repository;


    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $books = $this->repository->onlyTrashed()->orderBy('id')->paginate(5);
        return view('codeedubook::trashed.books.index', compact('books', 'search'));

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->repository->onlyTrashed();
        $book = $this->repository->find($id);
        return view('codeedubook::trashed.books.show', compact('book'));

    }

    public function update(Request $request, $id){
        $this->repository->onlyTrashed();
        $this->repository->restore($id);

        $url = $request->get('redirect_to', route('trashed.books.index'));
        $request->session()->flash('message', 'Livro restaurado com sucesso!');
        return redirect()->to($url);
    }




}
