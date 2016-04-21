@extends('layouts.bothhome')

@section('button')

    {{ Form::open(array('url' => route('gsend', ['gchatkey' => $gchatkey]), 'method' => 'post')) }}
      {{ Form::text('message', null,['id'=>'textin']) }}
      {{ Form::submit('Send', ['class' => 'btn btn-default send' , 'id' => 'sendbut']) }}
    {{ Form::close() }}

@endsection
