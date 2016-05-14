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
              <li><a href="#" class="feed-dropdown-option" data-sourceid="{{$source->id}}">{{$source->title}}</a></li>
              @endforeach
              <!--li role="separator" class="divider"></li-->
            </ul>
          </div>
          <ul id="sortable-source" class="list-group feed-items">
            @for ($i = 0; $i < 10; $i++)
              <li class="list-group-item"><span class="badge">DELETE</span>Source Item {{$i + 1}}</li>
            @endfor
          </ul>
      </div>
      <div class="col-xs-6">
          <h2>Managed Feeds</h2>
          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Select Feed
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <li><a href="#" class="feed-dropdown-option">Action</a></li>
              <li><a href="#" class="feed-dropdown-option">Another action</a></li>
              <li><a href="#" class="feed-dropdown-option">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#" class="feed-dropdown-option">Separated link</a></li>
            </ul>
          </div>
          <ul id="sortable-custom" class="list-group feed-items">
            @for ($i = 0; $i < 10; $i++)
              <li class="list-group-item"><span class="badge">DELETE</span>Managed Item {{$i + 1}}</li>
            @endfor
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
