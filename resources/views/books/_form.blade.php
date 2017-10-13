{{--Redirecionamento para página--}}
{!! Form::hidden('redirect_to', URL::previous()) !!}

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Título</label>
    <div class="col-sm-10">

        @if(isset($book))
            <input type="text" class="form-control" name="title" value="{{ $book->title }}">
        @else
            <input type="text" class="form-control" name="title" placeholder="Insira um título">
        @endif

        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Sub-título</label>
    <div class="col-sm-10">

        @if(isset($book))
            <input type="text" class="form-control" name="subtitle" value="{{ $book->subtitle }}">
        @else
            <input type="text" class="form-control" name="subtitle" placeholder="Insira um sub-título">
        @endif

        <span class="help-block">
            <strong>{{ $errors->first('subtitle') }}</strong>
        </span>
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label">Preço</label>
    <div class="col-sm-10">

        @if(isset($book))
            <input type="text" class="form-control" name="price" value="{{ $book->price }}">
        @else
            <input type="text" class="form-control" name="price" placeholder="Insira um preço">
        @endif

        <span class="help-block">
            <strong>{{ $errors->first('price') }}</strong>
        </span>
    </div>
</div>

        @if(isset($book))
            <input type="hidden" class="form-control" name="author" value="{{ $book->author_id }}">
        @else
            <input type="hidden" class="form-control" name="author" value=" {{ Auth::user()->id }}">
        @endif

