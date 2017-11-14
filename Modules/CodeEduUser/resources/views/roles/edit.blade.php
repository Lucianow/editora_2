@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Papel</h3>

        </div>
        <div class="row">
            <h4>Papel</h4>

            {!! Form::model($role,['route'=> ['codeeduuser.roles.update','role' => $role->id], 'class' => 'form', 'method' =>'PUT'])   !!}

            @include('codeeduuser::roles._formd')

            {!! Html::openFormGroup() !!}
                {!! Button::primary('Salvar Alteração')->submit() !!}
            {!! Html::closeFormGroup() !!}

            {!! Form::close()  !!}

        </div>
    </div>
@endsection