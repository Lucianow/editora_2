@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <h3>Novo Livro</h3>
        </div>

        <div class="row">

            {!!   Form::open(['route'=> 'books.store', 'class' => 'form'])   !!}

                @include('codeedubook::books._form')

                {!! Html::openFormGroup() !!}
                    {!! Button::primary('Inserir Livro')->submit() !!}
                {!! Html::closeFormGroup() !!}

            {!!   Form::close()   !!}
        </div>
    </div>
@endsection