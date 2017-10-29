{{--Redirecionamento para página--}}
{!! Form::hidden('redirect_to', URL::previous()) !!}

{{--Template do formulário--}}
{!!  Html::openFormGroup('name', $errors) !!}
    {!! Form::label('name' , 'Nome', ['class' => 'control-label'])  !!}
    {!! Form::text('name' , null, ['class' => 'form-control'])   !!}
    {!! Form::error('name', $errors) !!}
{!! Html::closeFormGroup() !!}