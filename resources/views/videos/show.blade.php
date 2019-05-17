@extends('layouts.app')

@section('content')

<div class="con-single">
	
		<div class="col-lg-12 ">
		<video width="990" height="400" controls  autoplay  id="videoElementID">  
			
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
				<div class="interaction">
					<a href="#" class="like" data-videoId="{{$video->id}}" id="lk" > like </a>
					<span id="count" data-count="{{route('countlike',[$video->id])}}"></span> ~
					<a href="#" class="like" data-videoId="{{$video->id}}" > Dislike </a>
					<span id="discount"></span>
				</div>
				<span class="col-md-3"><span><a href=""><i class="fa fa-list"></i><span>
				<span class="col-md-3">
					<span>
						<form action="{{route('flag',[$video->id])}}" method="POST">
                			 @csrf
							 <button type="submit" class="btn-primary">
								<i class="fa fa-flag"></i>
							</button>
                        </form>
						
					</span>
				</span>
				<span class="col-md-3"><span><a href=""><i class="fa fa-share-square"></i><span><i class="fa fa-user-circle"></i></span></a></span></span>
			</div>
			<p><span class="glyphicon glyphicon-search"></span> By {{$video->producer}}</p>
			<div class="post-desc">
				<p>{{$video->description}}</p>
				<div>
					<h3>Share Video</h3>
					
				</div>
			</div>
		</div>
		<div id="backend-comment" style="margin-top: 50px;">
			<h3> Comments <small> ({{ $video->comments()->count() }} )</small></h3>

		<table class="table table-stripped ">
			<thead>
				<tr>
				
				<th>Comment</th>
							
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
							<button class="btn btn-primary btn-md" type="submit">reply</button>
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
		<div class="post-comments">
			<form action="{{route('comment.store')}}" method="POST">
				@csrf
				<div class="form-group">
				<input type="hidden" name="id" value="{{$video->id}}">
					<label>Comment</label><br>
					<textarea name="body" class="form-control"></textarea><br>
				</div>
				<button class="btn btn-primary" type="submit">Comment</button>
			</form>
		</div>
	</div>
	<div class="side-bar bs-docs-grid row show-grid">
		@for($i = 0; $i < 10; $i++)
			<div class="in-p col-md-6">
				<div class="rel-post-thumbnail2">
				
				</div>
				<div class="rel-post-data2">
					<div class="rel-post-title2">
						<a href="#">Test Title</a>
					</div>
					<div class="rel-post-meta2">

					</div>
				</div>
			</div>
		@endfor
	</div>
    
	
</div>
</div>

@endsection

