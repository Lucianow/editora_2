@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <h3>Novo Papel</h3>
        </div>

        <div class="row">

            {!!   Form::open(['route'=> 'codeeduuser.roles.store', 'class' => 'form'])  !!}

                @include('codeeduuser::roles._form')

                {!! Html::openFormGroup() !!}
                    {!! Button::primary('Inserir Papel')->submit() !!}
                {!! Html::closeFormGroup() !!}

            {!!  Form::close()   !!}
        </div>
    </div>
@endsection