@extends('layouts.app')

@section('content')

<div class="con-single">
	
		<div class="col-lg-12 ">
		<video width="1200" height="600" controls  autoplay >  
			<source src="{{URL::asset('movie.mp4')}}" type="video/mp4">  
			<source src="{{URL::asset('movie.ogg')}}" type="video/ogg"> 
			<source src="/storage/video-bank/{{$video->video_file}}" type="video/mp4"> 
			
			Your browser does not support the video tag.
		</video>
		</div>
		<div class=" v-con ">
		<div class="post-title">
			<h3>{{$video->title}}</h3>
		</div>
		
		<div class="post-meta-single">
			<div class="row show-grid action-box">
				<span class="col-md-3"><span>
				<a action="{{route('likes.store')}}" method="POST">
					
						
						<input type="hidden" name="id" value="{{$video->id}}">
						
						<button  type="submit">
						<i class="fa fa-thumbs-up" ></i>
					</button>
				</a>	
				</span></span>
				<span class="col-md-3"><span><a href=""><i class="fa fa-thumbs-down"></i>25</a></span></span>
				<span class="col-md-3"><span><a href=""><i class="fa fa-list"></i><sup><i class="fa fa-plus-square"></i></sup></a></span></span>
				<span class="col-md-3"><span><a href=""><i class="fa fa-share-square"></i><sup><i class="fa fa-user-circle"></i></sup></a></span></span>
			</div>
			<p><span class="glyphicon glyphicon-search"></span> By {{$video->producer}}</a></p>
			<div class="post-desc">
				<p>{{$video->description}}</p>
			</div>
		</div>
        
        <span></span>
		<hr>
		<div id="backend-comment" style="margin-top: 50px;">
			<h3> Comments <small> {{ $video->comments()->count() }} total</small></h3>

		<table class="table table-stripped ">
			<thead>
				<tr>
				
				<th>Comment</th>
				<th width="70px;"></th>
				</tr>
				
			</thead>
			<tbody>
				@foreach($video->comments as $comment)
				<tr>
					
					<td>{{ $comment->body }}</td>
					<td>
					@foreach($comment->recomments as $reply)
					<td>
						{{$reply->body}}
					</td>
					@endforeach
					</td>
					<td>
					<div class="post-comments">
						<form action="{{route('replycomment.store')}}" method="POST">
							@csrf
							<div class="form-group">
							<input type="hidden" name="id" value="{{$comment->id}}">
								<label>Reply</label><br>
								<textarea name="body" class="form-control"></textarea><br>
							</div>
							<button class="btn btn-primary btn-md" type="submit">Post</button>
						</form>
					</div>
					</td>
					<td>
						<a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span>Edit</a>
						<a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span>Delete</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		</div>
		</div>
        <span></span>
		<div class="post-comments">
			<form action="{{route('comment.store')}}" method="POST">
				@csrf
				<div class="form-group">
				<input type="hidden" name="id" value="{{$video->id}}">
					<label>Comment</label><br>
					<textarea name="body" class="form-control"></textarea><br>
				</div>
				<button class="btn btn-primary" type="submit">Post Comment</button>
			</form>
		</div>

		</div>
	</div>
	
</div>
</div>
@endsection