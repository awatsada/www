@extends("guestbook.template")
@section("content")
  
ค้นหาเจอ {{$count}} รายการ <br/><br/>
@foreach($comments as $com)
<!-- start comment -->
  <div class="row col-md-12 well">
      {{$com->comment}}  
      <br/> <br/>        
      @can('show',$com) 
        <a href="{{url('guestbook/edit')}}/{{$com->id}}"><span class="glyphicon glyphicon-edit"></span></a>
        <a href="{{url('guestbook/delete')}}/{{$com->id}}"><span class="glyphicon glyphicon-remove"></span></a>    
      @endcan
            
      {{$com->updated_at}}  
 

      <b>Tags:</b>
      @foreach($com->tags as $ctag )
        <span class="label label-info">
          <a href="{{url('guestbook/searchTag')}}/{{$ctag->id}}" style="color:white;"> {{$ctag->name}} </a>
        </span>
        &nbsp;
      @endforeach        


      <div class="pull-right">
          <strong>From: </strong>
            {{$com->user->name}} ::  
            {{$com->ip}}
      </div>              
  </div> 
  <!-- stop comment -->
@endforeach

@endsection