@extends('layouts/admin')
@section('backend')
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Source Feeds
          <small>Managed Source RSS Feeds</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Sources</li>
        </ol>
      </section>
      @if(!empty(Session::get('message')))
        <section class="col-lg-12">
          <div class="alert alert-success fade in" style="margin-top:18px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            {{Session::get('message')}}
          </div>
        </section>
      @endif

      <!-- Main content -->
      <section class="content">
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->

            <!-- TO DO List -->
            <div class="box box-primary">
              <div class="box-header">
                <i class="ion ion-clipboard"></i>

                <h3 class="box-title">All Source Feeds</h3>


                <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> <a href="{{URL::to('admin/sources/create')}}"> Add Source</a></button>

              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <ul class="todo-list">
                  @foreach($sources as $source)
                  <li>
                    <!-- todo text -->
                    <a href="/admin/sources/edit/{{$source->id}}"><span class="text">{{$source->title}}</span></a>

                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                      {{-- i class="fa fa-edit"></i> --}}
                      <a href="/admin/source/delete/{{$source->id}}"><i class="fa fa-trash-o"></i></a>
                    </div>
                  </li>
                  @endforeach
                </ul>
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix no-border">
                <div class="box-tools pull-left">
                  <ul class="pagination pagination-sm inline">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul>


                </div>
                <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> <a href="{{URL::to('admin/sources/create')}}"> Add Source</a></button>
              </div>
            </div>
            <!-- /.box -->
@stop
