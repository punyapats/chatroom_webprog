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

                    <form action="/send" method="post" class="chatform">
                        {{ Form::text('message') }}
                        {{ Form::submit('Send', ['class' => 'btn btn-large btn-primary send']) }}
                    </form>
                    
                </div>
            </div>
        </div>

        <div class="col-md-4 col-md"> 
            <div class="panel panel-default">
                <div class="panel-heading">Friend List</div>
                    <div class="panel-body">
                        <button type="button" class="col-md-offset-2 btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Add Friend</button>
                        <div class="lfriend">
                            @foreach ($friendlist as $friend)
                              <li>{{ $friend->name }}</li>
                            
                            @endforeach
                        </div>
                    </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Friend</h4>
              </div>

              <form action="add" method="post">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="usr">Username:</label>
                    <input type="text" class="form-control" id="usr">
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-default" id="add">Add</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </form>


            </div>

          </div>
        </div>


    </div>
</div>
@endsection
