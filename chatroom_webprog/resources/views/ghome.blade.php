@extends('layouts.bothhome')

@section('name')
  Group -
  @if(isset($gname))
  @if(is_array($gname) || is_object($gname))
      {{ $gname->groupname }}
  @endif
  @endif

@endsection

@section('button')

    {{ Form::open(array('url' => route('gsend', ['gchatkey' => $gchatkey]), 'method' => 'post')) }}
      {{ Form::text('message', null,['id'=>'textin']) }}
      {{ Form::submit('Send', ['class' => 'btn btn-default send' , 'id' => 'sendbut']) }}
    {{ Form::close() }}

@endsection
