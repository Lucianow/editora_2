@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <h3>Novo Usuário</h3>
        </div>

        <div class="row">

            {!!   Form::open(['route'=> 'codeeduuser.users.store', 'class' => 'form'])  !!}

                @include('codeeduuser::users._form')

                {!! Html::openFormGroup() !!}
                    {!! Button::primary('Inserir Usuário')->submit() !!}
                {!! Html::closeFormGroup() !!}

            {!!  Form::close()   !!}
        </div>
    </div>
@endsection