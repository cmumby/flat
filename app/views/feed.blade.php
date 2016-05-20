@extends('layouts/tool')
@section('form')
  <div class="row">
      <div class="col-xs-6">
          <h2>Source Feeds</h2>
          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuSource" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Select Source
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuSource">
              @foreach ($sources as $source)
              <li><a href="#" class="feed-dropdown-option" data-sourceid="{{$source->id}}">{{$source->title}}</a> {{-- <span class="badge edit">Edit</span> --}}</li>
              @endforeach
              <li role="separator" class="divider"></li>
              <li><a href="#" class="feed-dropdown-option">Add New Source</a></li>

            </ul>
          </div>
          <ul id="sortable-source" class="list-group feed-items">
            {{-- @for ($i = 0; $i < 10; $i++)
              <li class="list-group-item"><span class="badge">DELETE</span>Source Item {{$i + 1}}</li>
            @endfor --}}
          </ul>
      </div>
      <div class="col-xs-6">
          <h2>Managed Feeds
            <span class="badge save hide">Save Feed</span>
            <span class="badge create hide">Create Item</span>
            <span class="badge collapse hide">Collapse Items</span>
          </h2>
          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuFeed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Select Feed
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuFeed">
              @foreach ($feeds as $feed)
              <li><a href="#" class="feed-dropdown-option" data-sourceid="{{$feed->id}}">{{$feed->title}}</a></li>
              @endforeach
            </ul>
          </div>
          <ul id="sortable-custom" class="list-group feed-items">
            {{-- @for ($i = 0; $i < 10; $i++)
              <li class="list-group-item"><span class="badge">DELETE</span>Managed Item {{$i + 1}}</li>
            @endfor --}}
          </ul>
      </div>
  </div>
  <hr>
  <div class="row">
      <div class="col-xs-12">
          <footer>
              <p>&copy; Copyright 2016</p>
          </footer>
      </div>
  </div>
@stop
