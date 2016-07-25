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
      $items = ITEM::where('feed_id', $id)->orderBy('weight','ASC')->get();
      foreach($items as $item){
        $content[] = array(
                        "id" =>  $item->id,
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
    $data = Input::all();
    $weight = 0;
    if($type == 'managed'){
      foreach($data['items'] as $item){
        $weight++;
        if(isset($item['id'])){
          $managed_item = ITEM::find($item['id']);
          //item already exists
          if(count($managed_item) == 0 ){
            $managed_item = new Item;
            $managed_item->feed_id = $id;
          }
          $managed_item->title = $item['title'];
          $managed_item->description = $item['description'];
          $managed_item->link = $item['link'];
          $managed_item->pubdate = $item['pubdate']; //date('D, d M Y H:i:s T', strtotime($item['pubdate']) );
          $managed_item->guid = $item['guid'];
          $managed_item->weight = $weight;
          $managed_item->save();
        }
      }
    }elseif($type == 'source'){
      if($id != 'new'){
        $source = Source::find($id);
        $source->title = $data['title'];
        $source->path = $data['path'];
        $source->save();
        $message = "<strong>Success!</strong> {$data['title']} has been updated";
        return Redirect::to("admin/sources/edit/{$id}")->with('message',$message);
      } elseif($id == 'new'){
        $new_source = new Source;
        $new_source->title = $data['title'];
        $new_source->path = $data['path'];
        $new_source->save();
        $message = "<strong>Success!</strong> {$data['title']} has been Created";
        return Redirect::to("admin/sources/edit/{$new_source->id}")->with('message',$message);
      }

    }
    return Response::make($data['items'], '200')->header('Content-Type', 'application/json');
  }

  public function showFeedsInterface(){
    $sources= SOURCE::all();
    $feeds= FEED::all();
    return View::make('feed')->with(array('title'=> 'FGT','sources'=>$sources,'feeds' => $feeds));
  }

  public function deleteItem(){
    $data = Input::all();
    Item::destroy($data['id']);
    $message = array('deleted-id' => $data['id'], 'message'=>'success');
    return Response::make($message, '200')->header('Content-Type', 'application/json');
  }

  public function showFeed($id){
    $feed = Feed::find($id);
    $items = ITEM::where('feed_id', $id)->orderBy('weight','ASC')->get();
    $content = View::make('item')->with(array('feed'=>$feed,'items' => $items));
    return Response::make($content, '200')->header('Content-Type', 'text/xml');
  }

  public function deleteFeed(){
    $data = Input::all();
    if(isset($data['type']) && $data['type'] == 'Source' ){
      Source::destroy($data['id']);
      $message = "<strong>Success!</strong> {$data['title']} has been deleted";
      return Redirect::to("admin/sources")->with('message',$message);
    }
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
