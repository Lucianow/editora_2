@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <h3>Listagem de Usuários</h3>
                {!! Button::primary('Inserir Usuário')->asLinkTo(route('codeeduuser.users.create')) !!}
            </div>

            <div class="col-md-6">
                {{  Form::model([], ['class' => 'form-inline text-right', 'method' =>'GET']) }}

                    {!! Form::label('search', 'Pesquisar usuário :', ['class'=> 'control-label']) !!}
                    {!! Form::text('search', null, ['class' => 'form-control']) !!}
                    {!! Button::primary('Buscar')->submit() !!}

                {{  Form::close()  }}

            </div>
        </div>

        <div class="row">
            {{ $users->links() }}

            {!! Table::withContents($users->items())->condensed()->striped()->callback('Ações', function($field, $user){
                    $linkEdit = route('codeeduuser.users.edit',['user' => $user->id]);
                    $linkDestroy = route('codeeduuser.users.destroy',['user' => $user->id]);
                    $deleteForm = "delete-form-{$user->id}";
                    $form = Form::open(['route'=>['codeeduuser.users.destroy', $user->id], 'method'=>'DELETE', 'id' => $deleteForm ]);
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