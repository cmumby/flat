@extends('layouts/rss')
@section('items')
  @foreach($items as $item)
    <item>
      <guid isPermaLink="false">{{$item->guid}}</guid>
        <link>{{$item->link}}</link>
        <title>{{$item->title}}</title>
        <description>{{$item->description}}</description>
        <pubDate>{{$item->pubdate}}</pubDate>
    </item>
  @endforeach
@stop
