@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Feed</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @foreach ($feed->children() as $post)
                    @if ($post->title && $post->summary)
                    <div>
                        <span>{{ $post->author }}</span>
                        <h3><b>{!! $post->title !!}</b></h3>
                        {!! $post->summary !!}
                        <b>
                            author: <a href="{{ $post->author->uri }}" target="_blank">{{ $post->author->name }}</a>
                        </b>
                        <a class="float-right" href="{{ $post->link->attributes()->href }}" target="_blank">
                            read more
                        </a>
                    </div>
                    <hr>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Most frequent words</div>
                <div class="card-body">
                    @php
                    $line = 1;
                    @endphp
                    @foreach ($most_frequent_words as $key => $value)
                    <p>{{ $line++ . '. ' . $key . " ($value)" }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection