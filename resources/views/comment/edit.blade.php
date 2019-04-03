@extends('layouts.app');

@section('title', '| Edit Comment')

@section('content')
	<div class="row">
	<div class="col-md-8 col-md-offset-2">
	<h1>Edit Comment</h1>
	{{ Form::model($comment, ['route' => ['comment.update', $comment->id], 'method' => 'PUT'])}}

	{{ Form::label('name', "Name:") }}
	{{ Form::text('name', null, ['class' => 'form-control', 'disabled' => ''])}}

	{{ Form::label('email', "Email:")}}
	{{ Form::email('email', null, ['class' => 'form-control', 'disabled' => ''])}}
	{{ Form::label('body', "Comment:")}}
	{{ Form::textarea('body', null, ['class' => 'form-control']) }}

	{{ Form::submit('Update Comment', ['class' => 'btn btn-md btn-primary', 'style' => 'margin-top: 15px;' ])}}
	{{ Form::close() }}
	</div>
	</div>
@endsection