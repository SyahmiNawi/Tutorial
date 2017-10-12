@include('modal.destroy-modal')
@extends('layouts.app')
@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <h2>Posts<a href="{{ url('/post/create') }}" class="btn btn-info pull-right" role="button">Create New Post</a></h2>
        
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="65%">Content</th>
                                <th width="15%">By</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody pull-{right}>
                        	<?php $i = 0 ?>
                            @forelse($posts as $post)
                                <tr>
                                    <td >{{ $posts->firstItem() + $i }}</td>
                                    <td>
                                    <form method="POST" action="/post/{{ $post->id }}/like" style="display: inline-block;">
                                    {{ csrf_field() }}

                                    <button class="btn {{ Auth::check() && Auth::user()->alreadyliked($post) ? 'btn-success' : 'btn-default' }}" style="width: 3em">
                                    {{ $post->likes->count() }} 
                                    </button>
                                    </form>
                                    &nbsp&nbsp{{ $post->post_content }}
                                    <small class="pull-right">
                                        {{ $post->created_at->diffForHumans() }}
                                    </small>
                                    </td>

									<td>{{ $post->user->name }}</td>
                                    <td>
                                    @if( $post->user_id == Auth::user()->id)
                                    	<a href="{{ action('PostsController@edit',	 $post->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{ action('PostsController@destroy',	 $post->id) }}" class="btn btn-danger btn-sm" id="confirm-modal">Delete</a>
                                    @endif
                                    </td>
                                </tr>
                                <?php $i++ ?>
                            @empty
                            <tr>
                                <td colspan="6">Looks like there is no post available.</td>
                            </tr>

                            @endforelse
                        </tbody>
                    </table>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/warning.js') }}"></script>
@endsection
