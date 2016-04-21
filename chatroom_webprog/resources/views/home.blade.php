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
  <input type="hidden" value="{{ $fchatkey }}" id="fkey">
@endsection


@section('script')

<script type="text/javascript">
  $(document).ready(function()
    {
      var key = $('#fkey').val();
      setInterval(function(){
          $.ajax({
              type: "GET",
              url: "/update",
              data: {
                  fchatkey : key
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