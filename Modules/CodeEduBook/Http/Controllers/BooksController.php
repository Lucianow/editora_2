<?php

namespace CodeEduBook\Http\Controllers;

use CodePub\Http\Controllers\Controller;
use CodePub\Http\Controllers\ModelNotFoundException;
use CodeEduBook\Http\Requests\BookRequest;
use CodeEduBook\Repositories\BookRepository;
use CodeEduBook\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use CodeEduBook\Models\Book;
use CodePub\Criteria\FindByTitleCriteria;

class BooksController extends Controller
{

    private $repository;

    private $categoryRepository;

    public function __construct(BookRepository $repository, CategoryRepository $categoryRepository)
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $books = $this->repository->orderBy('id')->paginate(5);
        return view('codeedubook::books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->orderBy('name')->lists('name', 'id');
        return view('codeedubook::books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $data = $request->all();
        $data['author_id'] = \Auth::user()->id;
        $this->repository->create($data);

        $url = $request->get('redirect_to', route('books.index'));
        $request->session()->flash('message', 'Livro cadastrado com sucesso!');
        return redirect()->to($url);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = $this->repository->find($id);
        $this->categoryRepository->withTrashed();
        $categories = $this->categoryRepository->orderBy('name')->listsWithMutators('name_trashed', 'id');
        return view('codeedubook::books.edit', compact('book','categories' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, $id)
    {

        if(!($book = Book::query()->find($id))){
            throw new ModelNotFoundException('Livro não encontrado ...');
        }

        $login = \Auth::user()->id;

        if ($login == $book->author_id){
            $this->repository->update($request->all(), $id);
            $url = $request->get('redirect_to', route('books.index'));
            $request->session()->flash('message', 'Livro alterado com sucesso!');
            return redirect()->to($url);

        }else{
            $url = $request->get('redirect_to', route('books.index'));
            $request->session()->flash('message', 'Você não tem permissão para alterar este livro!');
            return redirect()->to($url);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Book $book)
    {
        $login = \Auth::user()->id;
        $url = $request->get('redirect_to', route('books.index'));

        if ($login == $book->author_id) {
            $book->delete();
            \Session::flash('message', 'Livro excluído com sucesso!');
            return redirect()->to($url);
        }else{

            \Session::flash('message', 'Somente o autor tem permissão para excluir este livro!');
            return redirect()->to($url);
        }
    }
}
