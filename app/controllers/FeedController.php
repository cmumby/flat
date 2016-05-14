<?php

class FeedController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getSourceFeed($id)
	{
    $source = SOURCE::find($id);
    $content = $this->getSourceData($source->path);

    return Response::make($content, '200')->header('Content-Type', 'application/json');
	}

  public function showFeedsInterface(){
    $sources= SOURCE::all();
    //var_dump($sources); die();
    return View::make('feed')->with(array('title'=> 'FGT','sources'=>$sources));
  }

  private function getSourceData($path){
    $content = trim(file_get_contents($path));
    $xml = simplexml_load_string($content, "SimpleXMLElement", LIBXML_NOCDATA);

    foreach ($xml->channel->item as $item){
      $data[] = $item;
    }
    $json = json_encode($data);
    return $json;
  }



}
