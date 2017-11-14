@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <h3>Papeis de usuários do sistema</h3>
                {!! Button::primary('Inserir Papel')->asLinkTo(route('codeeduuser.roles.create')) !!}
            </div>

            <div class="col-md-6">
                {{  Form::model([], ['class' => 'form-inline text-right', 'method' =>'GET']) }}

                    {!! Form::label('search', 'Pesquisar papel :', ['class'=> 'control-label']) !!}
                    {!! Form::text('search', null, ['class' => 'form-control']) !!}
                    {!! Button::primary('Buscar')->submit() !!}

                {{  Form::close()  }}

            </div>
        </div>

        <div class="row">
            {{ $roles->links() }}

            {!! Table::withContents($roles->items())->condensed()->striped()->callback('Ações', function($field, $role){
                    $linkEdit = route('codeeduuser.roles.edit',['role' => $role->id]);
                    $linkDestroy = route('codeeduuser.roles.destroy',['role' => $role->id]);
                    $deleteForm = "delete-form-{$role->id}";
                    $form = Form::open(['route'=>['codeeduuser.roles.destroy', $role->id], 'method'=>'DELETE', 'id' => $deleteForm ]);
                    $deleteButton = Form::submit('Excluir',['class'=>'btn btn-link']).Form::close();
                    $destroy = '<a title="Não é possivel excluir o papel mestre!"><del>Excluir</del></a>';
                    $teste = $role->name == config('codeeduuser.acl.role_admin') ? $destroy : $form.$deleteButton;


                    return 	"<ul class=\"list-inline\">".
                                "<li>".Button::link('Editar')->asLinkTo($linkEdit)."</li>".
                                "<li>|</li>".
                                "<li>".$teste."</li>".
                            "</ul>";
			}) !!}

        </div>
    </div>

@endsection