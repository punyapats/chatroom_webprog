@extends('layouts.app')

@section('content')
<div class="container chatbox">
    <div class="row">
        <div class="col-md-8 col-md">    
            <div class="panel panel-default">
                <div class="panel-heading">ChatBox - 
                    @if(isset($fname))
                    @if(is_array($fname) || is_object($fname))
                      @foreach($fname as $names)
                        {{ $names->name }}
                      @endforeach
                    @endif
                    @endif

                </div>
                <div class="panel-body chatbody">
                    <div class="chat">
                      @if(isset($chat))
                      @if(is_array($chat) || is_object($chat))
                        @foreach($chat as $cchat)
                          <p>{{ $cchat->date }} - {{ $cchat->text }}</p>
                        @endforeach
                      @endif
                      @endif
                    </div>
                    <br>
                    <div class="textin">
                      {{ Form::open(array('url' => route('send', ['fchatkey' => $fchatkey]), 'method' => 'post')) }}
                        {{ Form::text('message', null,['id'=>'textin']) }}
                        {{ Form::submit('Send', ['class' => 'btn btn-default send' , 'id' => 'sendbut']) }}
                      {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-md"> 
            <div class="panel panel-default">
                <div class="panel-heading">Friend List</div>
                    <div class="panel-body">
                       <button type="button" class="col-md-offset-8 btn btn-default btn-md addbut" data-toggle="modal" data-target="#myModal">Add Friend</button>
                        <div class="lfriend" id="friend">
                          <ul>
                            @if(isset($friendlist))
                              @foreach ($friendlist as $friend)
                                <li><a href="/chat/{{ $friend->fchatkey }}">{{ $friend->name }}</a></li>
                              
                              @endforeach
                            @endif
                          </ul>  
                        </div>
                        <button type="button" class="col-md-offset-8 btn btn-info btn-md" data-toggle="modal" data-target="#createModal">Create Group</button>
                    </div>
            </div>
        </div>




        <!-- Add Friend Modal -->
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
                  <button type="button" class="btn btn-default" id="add">Add</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>

          </div>
        </div>
        <!-- Create Group Modal -->
        <div id="createModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create Group</h4>
              </div>

              <form action="add" method="post">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="gname">Groupname</label>
                    <input type="text" class="form-control" id="gname">
                    @if(isset($friendlist))
                              @foreach ($friendlist as $friend)
                                <input type='checkbox' value='{{$friend->friend}}'>{{$friend->name}}
                                <br>
                              @endforeach
                    @endif
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default" id="createg">Create</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>

          </div>
        </div>


    </div>
</div>
@endsection
