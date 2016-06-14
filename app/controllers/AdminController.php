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

}
