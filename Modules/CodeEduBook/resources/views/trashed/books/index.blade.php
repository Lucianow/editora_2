@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <h3>Lixeira de Livros</h3>
            </div>

            <div class="col-md-6">
                {!! Form::model([], ['class' => 'form-inline text-right', 'method' =>'GET']) !!}

                    {!! Form::label('search', 'Pesquisar por título :', ['class'=> 'control-label']) !!}
                    {!! Form::text('search', null, ['class' => 'form-control']) !!}

                    {!! Button::primary('Buscar')->submit() !!}

                {!! Form::close() !!}

            </div>
        </div>

        <div class="row">

            @if($books->count() > 0)

            {{ $books->links() }}

            {!! Table::withContents($books->items())->condensed()->striped()->callback('Ações', function($field, $book){
                    $linkView = route('trashed.books.show', ['book' => $book->id]);
                    $linkDestroy = route('books.destroy',['book' => $book->id]);
                    $restoreForm = "delete-form-{$book->id}";
                    $form = Form::open(['route'=>['trashed.books.update', $book->id], 'method'=>'PUT', 'id' => $restoreForm ]).Form::hidden('redirect_to', URL::previous());
                    $restoreButton = Form::submit('Restaurar',['class'=>'btn btn-link']).Form::close();

                    return 	"<ul class=\"list-inline\">".
                                "<li>".Button::link('Ver')->asLinkTo($linkView)."</li>".
                                "<li>|</li>".
                                "<li>".$form.$restoreButton."</li>".
                            "</ul>";
			}) !!}

            @else

                    <div class="col-md-8 col-md-offset-2" style="padding-top: 100px">
                        <div class="panel panel-default">

                            <div class="panel-body">
                                <h3 class="text-center">Lixeira vazia</h3>
                            </div>
                        </div>
                    </div>

            @endif

        </div>
    </div>

@endsection