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
    <input type="hidden" value="{{ $gchatkey }}" id="gkey">
@endsection


@section('script')

<script type="text/javascript">
  $(document).ready(function()
    {
      var key = $('#gkey').val();
      setInterval(function(){
          $.ajax({
              type: "GET",
              url: "/gupdate",
              data: {
                  gchatkey : key
              },
              success:function(res)
              {
                  // alert(res[0]['text']);
                  $("div.chat").empty();
                  $.each(res,function(index,value){
                      $("div.chat").append('<p>'+value['date']+" - "+value['text']+'</p>');
                  });
              }
          });
      },10000);
    });
</script>
@endsection