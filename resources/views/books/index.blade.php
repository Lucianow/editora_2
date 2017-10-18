@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <h3>Listagem de Livros</h3>
                <a href="{{ route('books.create') }}" class="btn btn-primary">Inserir Livro</a>
            </div>

            <div class="col-md-6">
                {{  Form::model([], ['class' => 'form-inline text-right', 'method' =>'GET']) }}

                    {!! Form::label('search', 'Pesquisar por título :', ['class'=> 'control-label']) !!}
                    {!! Form::text('search', null, ['class' => 'form-control']) !!}

                    {!! Button::primary('Buscar')->submit() !!}

                {{  Form::close()  }}

            </div>
        </div>

        <div class="row">
            {{ $books->links() }}

            {!! Table::withContents($books->items())->condensed()->striped()->callback('Ações', function($field, $book){
                    $linkEdit = route('books.edit', ['book' => $book->id]);
                    $linkDestroy = route('books.destroy',['book' => $book->id]);
                    $deleteForm = "delete-form-{$book->id}";
                    $form = Form::open(['route'=>['books.destroy', $book->id], 'method'=>'DELETE', 'id' => $deleteForm ]);
                    $deleteButton = Form::submit('Excluir',['class'=>'btn btn-link']).Form::close();

                    return 	"<ul class=\"list-inline\">".
                                "<li>".Button::link('Editar')->asLinkTo($linkEdit)."</li>".
                                "<li>|</li>".
                                "<li>".$form.$deleteButton."</li>".
                            "</ul>";
			}) !!}

        </div>
    </div>

@endsection