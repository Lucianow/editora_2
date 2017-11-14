{{--Redirecionamento para página--}}
{!! Form::hidden('redirect_to', URL::previous()) !!}

{{--Template do formulário--}}

@if($role->name == config('codeeduuser.acl.role_admin'))

    {!!  Html::openFormGroup('name', $errors) !!}
    {!! Form::label('name' , 'Nome', ['class' => 'control-label'])  !!}
    {!! Form::text('name' , null,  ['class' => 'form-control', 'disabled' => 'disabled' ])   !!}
    {!! Form::error('name', $errors) !!}
    {!! Html::closeFormGroup() !!}

@else

    {!!  Html::openFormGroup('name', $errors) !!}
    {!! Form::label('name' , 'Nome', ['class' => 'control-label'])  !!}
    {!! Form::text('name' , null,  ['class' => 'form-control' ])   !!}
    {!! Form::error('name', $errors) !!}
    {!! Html::closeFormGroup() !!}

@endif


{!!  Html::openFormGroup('description', $errors) !!}
    {!! Form::label('description' , 'Descrição', ['class' => 'control-label'])  !!}
    {!! Form::text('description' , null, ['class' => 'form-control'])   !!}
    {!! Form::error('description', $errors) !!}
{!! Html::closeFormGroup() !!}