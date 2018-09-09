<h5>Ostatnia Aktywność:</h5>
<?php $posts = $uzytkownik->posts()->with('topics')->paginate(config('app.pagination_profile_posts')); ?>
@foreach( $posts as $post )
    Temat: <a href="{{ route('temat.show', $post->topics->url) }}"><span class="text-info">{{ $post->topics->name }}</span></a><br />
    <i class="fa fa-comment" aria-hidden="true"></i><span class="pl-4">{{ $post->content }}</span><br />
    <span class="text-muted small"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ $post->date }}</span> <span class="text-muted small ml-4">{{ $post->topics->posts->count() }} odpowiedzi</span><br />
    <div class="margin-bottom-small"></div>
@endforeach
{{ $posts->links() }}