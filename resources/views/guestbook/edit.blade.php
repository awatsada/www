@extends("guestbook.template")
@section("content")
 
	<div class="row col-md-12">	
		<!-- stories-->             
       		<div class="form-group well">
          		{!! Form::open(['url' => array('guestbook/saveComment',$comment->id) ]) !!}
		        {!! Form::label('name','Name:') !!}		        
		        {{  $comment->user->name }} <br>
		        {!! Form::textarea('comment', $comment->comment , ['class' => 'form-control', 'rows' => '5', 'required' => 'required']) !!}<br/>
		        {!! Form::hidden('ip',Request::getClientIp(),['class' => 'form-control'])!!}
 		          @foreach ($tags as $tag)  				
 		          	  {{--*/ @$chk = false /*--}} 		          	  
	 		          @foreach($comment->tags as $ctag)  	 		          	
	 		          	@if( $tag->id == $ctag->id )
			            	{{--*/  @$chk = true /*--}}			            	
			            @endif			            
			          @endforeach				            
			          {{ Form::checkbox('tags[]',$tag->id, $chk) }} {{$tag->name}} &nbsp; 
		          @endforeach	
					<br>

		          <br><br>                
				{!! Form::submit('submit',['class' => 'btn btn-primary btn-sm']) !!}		       
			    {!! Form::close() !!}
			</div>		   			  	
         <!--/stories--> 	
	</div>
</div>
@endsection
