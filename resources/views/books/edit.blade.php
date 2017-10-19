@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Livro</h3>

        </div>
        <div class="row">
            {!!   Form::model($book,['route'=> ['books.update', 'book' => $book->id], 'class' => 'form', 'method' =>'PUT'])   !!}

            @include('books._form')

            <div class="form-group">
                {!!  Form::hidden('autor_id' , null, ['class' => 'form-control'])   !!}
            </div>

            {!!  Html::openFormGroup() !!}
                {!! Button::primary('Salvar Alteração')->submit() !!}
            {!! Html::closeFormGroup() !!}

            {!!  Form::close()   !!}
        </div>
    </div>
@endsection