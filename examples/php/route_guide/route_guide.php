<?php
// DO NOT EDIT! Generated by Protobuf-PHP protoc plugin 1.0
// Source: route_guide.proto
//   Date: 2015-08-31 21:11:45

namespace routeguide {

  class Point extends \DrSlump\Protobuf\Message {

    /**  @var int */
    public $latitude = 0;
    
    /**  @var int */
    public $longitude = 0;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'routeguide.Point');

      // OPTIONAL INT32 latitude = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "latitude";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->default   = 0;
      $descriptor->addField($f);

      // OPTIONAL INT32 longitude = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "longitude";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->default   = 0;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <latitude> has a value
     *
     * @return boolean
     */
    public function hasLatitude(){
      return $this->_has(1);
    }
    
    /**
     * Clear <latitude> value
     *
     * @return \routeguide\Point
     */
    public function clearLatitude(){
      return $this->_clear(1);
    }
    
    /**
     * Get <latitude> value
     *
     * @return int
     */
    public function getLatitude(){
      return $this->_get(1);
    }
    
    /**
     * Set <latitude> value
     *
     * @param int $value
     * @return \routeguide\Point
     */
    public function setLatitude( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <longitude> has a value
     *
     * @return boolean
     */
    public function hasLongitude(){
      return $this->_has(2);
    }
    
    /**
     * Clear <longitude> value
     *
     * @return \routeguide\Point
     */
    public function clearLongitude(){
      return $this->_clear(2);
    }
    
    /**
     * Get <longitude> value
     *
     * @return int
     */
    public function getLongitude(){
      return $this->_get(2);
    }
    
    /**
     * Set <longitude> value
     *
     * @param int $value
     * @return \routeguide\Point
     */
    public function setLongitude( $value){
      return $this->_set(2, $value);
    }
  }
}

namespace routeguide {

  class Rectangle extends \DrSlump\Protobuf\Message {

    /**  @var \routeguide\Point */
    public $lo = null;
    
    /**  @var \routeguide\Point */
    public $hi = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'routeguide.Rectangle');

      // OPTIONAL MESSAGE lo = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "lo";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\routeguide\Point';
      $descriptor->addField($f);

      // OPTIONAL MESSAGE hi = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "hi";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\routeguide\Point';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <lo> has a value
     *
     * @return boolean
     */
    public function hasLo(){
      return $this->_has(1);
    }
    
    /**
     * Clear <lo> value
     *
     * @return \routeguide\Rectangle
     */
    public function clearLo(){
      return $this->_clear(1);
    }
    
    /**
     * Get <lo> value
     *
     * @return \routeguide\Point
     */
    public function getLo(){
      return $this->_get(1);
    }
    
    /**
     * Set <lo> value
     *
     * @param \routeguide\Point $value
     * @return \routeguide\Rectangle
     */
    public function setLo(\routeguide\Point $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <hi> has a value
     *
     * @return boolean
     */
    public function hasHi(){
      return $this->_has(2);
    }
    
    /**
     * Clear <hi> value
     *
     * @return \routeguide\Rectangle
     */
    public function clearHi(){
      return $this->_clear(2);
    }
    
    /**
     * Get <hi> value
     *
     * @return \routeguide\Point
     */
    public function getHi(){
      return $this->_get(2);
    }
    
    /**
     * Set <hi> value
     *
     * @param \routeguide\Point $value
     * @return \routeguide\Rectangle
     */
    public function setHi(\routeguide\Point $value){
      return $this->_set(2, $value);
    }
  }
}

namespace routeguide {

  class Feature extends \DrSlump\Protobuf\Message {

    /**  @var string */
    public $name = null;
    
    /**  @var \routeguide\Point */
    public $location = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'routeguide.Feature');

      // OPTIONAL STRING name = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "name";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      // OPTIONAL MESSAGE location = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "location";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\routeguide\Point';
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <name> has a value
     *
     * @return boolean
     */
    public function hasName(){
      return $this->_has(1);
    }
    
    /**
     * Clear <name> value
     *
     * @return \routeguide\Feature
     */
    public function clearName(){
      return $this->_clear(1);
    }
    
    /**
     * Get <name> value
     *
     * @return string
     */
    public function getName(){
      return $this->_get(1);
    }
    
    /**
     * Set <name> value
     *
     * @param string $value
     * @return \routeguide\Feature
     */
    public function setName( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <location> has a value
     *
     * @return boolean
     */
    public function hasLocation(){
      return $this->_has(2);
    }
    
    /**
     * Clear <location> value
     *
     * @return \routeguide\Feature
     */
    public function clearLocation(){
      return $this->_clear(2);
    }
    
    /**
     * Get <location> value
     *
     * @return \routeguide\Point
     */
    public function getLocation(){
      return $this->_get(2);
    }
    
    /**
     * Set <location> value
     *
     * @param \routeguide\Point $value
     * @return \routeguide\Feature
     */
    public function setLocation(\routeguide\Point $value){
      return $this->_set(2, $value);
    }
  }
}

namespace routeguide {

  class RouteNote extends \DrSlump\Protobuf\Message {

    /**  @var \routeguide\Point */
    public $location = null;
    
    /**  @var string */
    public $message = null;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'routeguide.RouteNote');

      // OPTIONAL MESSAGE location = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "location";
      $f->type      = \DrSlump\Protobuf::TYPE_MESSAGE;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->reference = '\routeguide\Point';
      $descriptor->addField($f);

      // OPTIONAL STRING message = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "message";
      $f->type      = \DrSlump\Protobuf::TYPE_STRING;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <location> has a value
     *
     * @return boolean
     */
    public function hasLocation(){
      return $this->_has(1);
    }
    
    /**
     * Clear <location> value
     *
     * @return \routeguide\RouteNote
     */
    public function clearLocation(){
      return $this->_clear(1);
    }
    
    /**
     * Get <location> value
     *
     * @return \routeguide\Point
     */
    public function getLocation(){
      return $this->_get(1);
    }
    
    /**
     * Set <location> value
     *
     * @param \routeguide\Point $value
     * @return \routeguide\RouteNote
     */
    public function setLocation(\routeguide\Point $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <message> has a value
     *
     * @return boolean
     */
    public function hasMessage(){
      return $this->_has(2);
    }
    
    /**
     * Clear <message> value
     *
     * @return \routeguide\RouteNote
     */
    public function clearMessage(){
      return $this->_clear(2);
    }
    
    /**
     * Get <message> value
     *
     * @return string
     */
    public function getMessage(){
      return $this->_get(2);
    }
    
    /**
     * Set <message> value
     *
     * @param string $value
     * @return \routeguide\RouteNote
     */
    public function setMessage( $value){
      return $this->_set(2, $value);
    }
  }
}

namespace routeguide {

  class RouteSummary extends \DrSlump\Protobuf\Message {

    /**  @var int */
    public $point_count = 0;
    
    /**  @var int */
    public $feature_count = 0;
    
    /**  @var int */
    public $distance = 0;
    
    /**  @var int */
    public $elapsed_time = 0;
    

    /** @var \Closure[] */
    protected static $__extensions = array();

    public static function descriptor()
    {
      $descriptor = new \DrSlump\Protobuf\Descriptor(__CLASS__, 'routeguide.RouteSummary');

      // OPTIONAL INT32 point_count = 1
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 1;
      $f->name      = "point_count";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->default   = 0;
      $descriptor->addField($f);

      // OPTIONAL INT32 feature_count = 2
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 2;
      $f->name      = "feature_count";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->default   = 0;
      $descriptor->addField($f);

      // OPTIONAL INT32 distance = 3
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 3;
      $f->name      = "distance";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->default   = 0;
      $descriptor->addField($f);

      // OPTIONAL INT32 elapsed_time = 4
      $f = new \DrSlump\Protobuf\Field();
      $f->number    = 4;
      $f->name      = "elapsed_time";
      $f->type      = \DrSlump\Protobuf::TYPE_INT32;
      $f->rule      = \DrSlump\Protobuf::RULE_OPTIONAL;
      $f->default   = 0;
      $descriptor->addField($f);

      foreach (self::$__extensions as $cb) {
        $descriptor->addField($cb(), true);
      }

      return $descriptor;
    }

    /**
     * Check if <point_count> has a value
     *
     * @return boolean
     */
    public function hasPointCount(){
      return $this->_has(1);
    }
    
    /**
     * Clear <point_count> value
     *
     * @return \routeguide\RouteSummary
     */
    public function clearPointCount(){
      return $this->_clear(1);
    }
    
    /**
     * Get <point_count> value
     *
     * @return int
     */
    public function getPointCount(){
      return $this->_get(1);
    }
    
    /**
     * Set <point_count> value
     *
     * @param int $value
     * @return \routeguide\RouteSummary
     */
    public function setPointCount( $value){
      return $this->_set(1, $value);
    }
    
    /**
     * Check if <feature_count> has a value
     *
     * @return boolean
     */
    public function hasFeatureCount(){
      return $this->_has(2);
    }
    
    /**
     * Clear <feature_count> value
     *
     * @return \routeguide\RouteSummary
     */
    public function clearFeatureCount(){
      return $this->_clear(2);
    }
    
    /**
     * Get <feature_count> value
     *
     * @return int
     */
    public function getFeatureCount(){
      return $this->_get(2);
    }
    
    /**
     * Set <feature_count> value
     *
     * @param int $value
     * @return \routeguide\RouteSummary
     */
    public function setFeatureCount( $value){
      return $this->_set(2, $value);
    }
    
    /**
     * Check if <distance> has a value
     *
     * @return boolean
     */
    public function hasDistance(){
      return $this->_has(3);
    }
    
    /**
     * Clear <distance> value
     *
     * @return \routeguide\RouteSummary
     */
    public function clearDistance(){
      return $this->_clear(3);
    }
    
    /**
     * Get <distance> value
     *
     * @return int
     */
    public function getDistance(){
      return $this->_get(3);
    }
    
    /**
     * Set <distance> value
     *
     * @param int $value
     * @return \routeguide\RouteSummary
     */
    public function setDistance( $value){
      return $this->_set(3, $value);
    }
    
    /**
     * Check if <elapsed_time> has a value
     *
     * @return boolean
     */
    public function hasElapsedTime(){
      return $this->_has(4);
    }
    
    /**
     * Clear <elapsed_time> value
     *
     * @return \routeguide\RouteSummary
     */
    public function clearElapsedTime(){
      return $this->_clear(4);
    }
    
    /**
     * Get <elapsed_time> value
     *
     * @return int
     */
    public function getElapsedTime(){
      return $this->_get(4);
    }
    
    /**
     * Set <elapsed_time> value
     *
     * @param int $value
     * @return \routeguide\RouteSummary
     */
    public function setElapsedTime( $value){
      return $this->_set(4, $value);
    }
  }
}

namespace routeguide {

  class RouteGuideClient extends \Grpc\BaseStub {

    public function __construct($hostname, $opts) {
      parent::__construct($hostname, $opts);
    }
    /**
     * @param routeguide\Point $input
     */
    public function GetFeature(\routeguide\Point $argument, $metadata = array(), $options = array()) {
      return $this->_simpleRequest('/routeguide.RouteGuide/GetFeature', $argument, '\routeguide\Feature::deserialize', $metadata, $options);
    }
    /**
     * @param routeguide\Rectangle $input
     */
    public function ListFeatures($argument, $metadata = array(), $options = array()) {
      return $this->_serverStreamRequest('/routeguide.RouteGuide/ListFeatures', $argument, '\routeguide\Feature::deserialize', $metadata, $options);
    }
    /**
     * @param routeguide\Point $input
     */
    public function RecordRoute($metadata = array()) {
      return $this->_clientStreamRequest('/routeguide.RouteGuide/RecordRoute', '\routeguide\RouteSummary::deserialize', $metadata);
    }
    /**
     * @param routeguide\RouteNote $input
     */
    public function RouteChat($metadata = array()) {
      return $this->_bidiRequest('/routeguide.RouteGuide/RouteChat', '\routeguide\RouteNote::deserialize', $metadata);
    }
  }
}
