@extends('layouts.bothhome')

@section('name')
  @if(isset($fname))
  @if(is_array($fname) || is_object($fname))
    @foreach($fname as $names)
      {{ $names->name }}
    @endforeach
  @endif
  @endif
@endsection

@section('button')
  {{ Form::open(array('url' => route('send', ['fchatkey' => $fchatkey]), 'method' => 'post', 'class'=>'chatform')) }}
    {{ Form::text('message', null,['id'=>'textin']) }}
    {{ Form::submit('Send', ['class' => 'btn btn-default send' , 'id' => 'sendbut']) }}
  {{ Form::close() }}

@endsection
