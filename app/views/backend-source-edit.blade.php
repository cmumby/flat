@extends('layouts/admin')
@section('backend')
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Source Feed: {{$source->title}}
          <small>{{$source->path}}</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="box box-info">
              <div class="box-header">
                <i class="ion ion-compose"></i>

                <h3 class="box-title">Edit</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                  <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
                <!-- /. tools -->
              </div>
              <div class="box-body">
                {{ Form::open(array('url' => 'foo/bar')) }}
                  <div class="form-group">
                    {{Form::text('title', $source->title , array("class"=>"form-control", "placeholder"=>"Title" ));}}
                  </div>
                  <div class="form-group">
                    {{Form::text('path', $source->path , array("class"=>"form-control", "placeholder"=>"Path" ));}}
                  </div>
                  <div>
                    <textarea class="textarea" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                  </div>
                {{ Form::close() }}
              </div>
              <div class="box-footer clearfix">
                <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
                  <i class="fa fa-arrow-circle-right"></i></button>
              </div>
            </div>
@stop
