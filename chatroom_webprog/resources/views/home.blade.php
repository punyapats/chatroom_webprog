@extends('layouts.app')

@section('content')
<div class="container chatbox">
    <div class="row">
        <div class="col-md-8 col-md">    
            <div class="panel panel-default">
                <div class="panel-heading">ChatBox</div>

                <div class="panel-body chatbody">
                    <div class="chat">
                        You are logged in!
                    </div>
                    {{ Form::text('message') }}
                    {{ Form::submit('Send', ['class' => 'btn btn-large btn-primary send']) }}
                </div>
            </div>
        </div>
        <div class="col-md-4 col-md"> 
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        You are logged in!
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
