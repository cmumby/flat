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

  public function getFeed($type,$id){
    $content = array();
    if($type == 'source'){
      $source = SOURCE::find($id);
      $content = $this->getSourceData($source->path);
    }
    if($type == 'managed'){
      $items = ITEM::where('feed_id', $id)->get();
      foreach($items as $item){
        $content[] = array(
                        "title" => $item->title,
                        "guid"  => $item->guid,
                        "link"  => $item->link,
                        "description" => $item->description,
                        "pubDate"  => $item->pubdate,
                     );
      }
    }
    return Response::make($content, '200')->header('Content-Type', 'application/json');
  }

  public function saveFeed($type,$id){
    return Response::make(Input::all(), '200')->header('Content-Type', 'application/json');
  }

  public function showFeedsInterface(){
    $sources= SOURCE::all();
    $feeds= FEED::all();
    return View::make('feed')->with(array('title'=> 'FGT','sources'=>$sources,'feeds' => $feeds));
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
