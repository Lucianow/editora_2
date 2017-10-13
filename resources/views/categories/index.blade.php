@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Listagem de Categorias</h3>
            {!! Button::primary('Inserir Categoria')->asLinkTo(route('categories.create')) !!}
        </div>

        <div class="row">
            {{  Form::model([], ['class' => 'form-inline text-right', 'method' =>'GET']) }}

            {!! Form::label('search', 'Pesquisar categoria :', ['class'=> 'control-label']) !!}
            {!! Form::text('search', null, ['class' => 'form-control']) !!}

            {!! Button::primary('Buscar')->submit() !!}

            {{  Form::close()  }}

            <hr>

        </div>
        <div class="row">
            {{ $categories->links() }}

            {!! Table::withContents($categories->items())->striped()->callback('Ações', function($field, $category){
                    $linkEdit = route('categories.edit',['category' => $category->id]);
                    $linkDestroy = route('categories.destroy',['category' => $category->id]);
                    $deleteForm = "delete-form-{$category->id}";
                    $form = Form::open(['route'=>['categories.destroy', $category->id], 'method'=>'DELETE', 'id' => $deleteForm ]);
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