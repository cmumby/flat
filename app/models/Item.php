<?php

class Item extends Eloquent {
  public function feed() {
        return $this->hasOne('feed'); // this matches the Eloquent model
  }
}
