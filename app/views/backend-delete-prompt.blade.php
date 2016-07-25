@extends('layouts/admin')
@section('backend')
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Delete {{$type}} Feed
          <small>{{$title}}</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
        <div class="alert alert-warning">
            <p><strong>Warning!</strong> Are you sure you want to delete <strong>{{$title}}</strong>? This action cannot be undone.</p>
            <br/>
            {{Form::open(array('action' => array('FeedController@deleteFeed'), 'method'=>'POST' ))}}
            {{Form::hidden('type', $type) }}
            {{Form::hidden('id', $id) }}
            {{Form::hidden('title', $title) }}
            <a href="{{URL::to('admin/sources')}}"><button type="button" class="btn btn-default"><i class="fa fa-plus"></i>Cancel</button></a>
            {{Form::button('<i class="fa fa-minus"></i>Delete',array('type'=>'submit','class'=>'btn btn-default')) }}

            {{Form::close()}}
        </div>
      </section>
@stop
