@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Livro</h3>

        </div>
        <div class="row">
            <form class="form-horizontal" method="post" action="{{route('books.update', $book->id)}}">

                {{ csrf_field()}}

                {{ method_field('PUT') }}

                @include('books._form')

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-info">Salvar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection