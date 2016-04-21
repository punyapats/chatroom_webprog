@extends('layouts.bothhome')

@section('button')
  {{ Form::open(array('url' => route('send', ['fchatkey' => $fchatkey]), 'method' => 'post')) }}
    {{ Form::text('message', null,['id'=>'textin']) }}
    {{ Form::submit('Send', ['class' => 'btn btn-default send' , 'id' => 'sendbut']) }}
  {{ Form::close() }}
@endsection