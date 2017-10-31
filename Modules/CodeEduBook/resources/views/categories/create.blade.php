@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <h3>Nova Categoria</h3>
        </div>

        <div class="row">

            {!!   Form::open(['route'=> 'categories.store', 'class' => 'form'])  !!}

                @include('codeedubook::categories._form')

                {!! Html::openFormGroup() !!}
                    {!! Button::primary('Inserir Categoria')->submit() !!}
                {!! Html::closeFormGroup() !!}

            {!!  Form::close()   !!}
        </div>
    </div>
@endsection