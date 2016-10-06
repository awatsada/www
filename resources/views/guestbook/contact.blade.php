@extends("guestbook.template")
@section("content")
  
<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

@if(isset($toEmail)) 
  <div class="alert alert-success">
   Your message has been email to <strong> {{$toEmail}} </strong>
  </div> 
@endif

<h4>Email to administrator </h4>

{!! Form::open(['url' => 'guestbook/submitEmail']) !!}  

<div class="form-group">    
    <b>From:</b> {{Auth::user()->name}} ( {{Auth::user()->email}} )
    {!! Form::hidden('name', Auth::user()->name ) !!}
    {!! Form::hidden('email', Auth::user()->email) !!}
</div> 
  

<div class="form-group">
    {!! Form::label('Subject:') !!}
    {!! Form::text('subject',null , 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'Your subject here')) !!}
</div>

<div class="form-group">
    {!! Form::label('Message:') !!}
    {!! Form::textarea('message', null, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'Your message here')) !!}
</div>

<div class="form-group">
    {!! Form::submit('Contact us', 
      array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}

@endsection