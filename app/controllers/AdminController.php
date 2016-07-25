<?php

class AdminController extends BaseController {

	public function showAdminInterface()
	{
		return View::make('backend');
	}

  public function showSources()
  {
    $sources = Source::all();
    return View::make('backend-source')->with(array('sources'=>$sources));
  }

  public function editSource($id){
    $source = Source::find($id);
    return View::make('backend-source-edit')->with(array('source'=>$source));
  }

  public function createSource(){
    return View::make('backend-source-create');
  }

  public function deletePrompt($type,$id){
    if($type == 'source'){
      $source = Source::find($id);
      $title = $source->title;
    }elseif($type == 'managed'){
      $feed = Feed::find($id);
      $title = $feed->title;
    }
    return View::make('backend-delete-prompt')->with(array('type'=>ucfirst($type),'id'=>$id, 'title' =>$title));
  }

}
