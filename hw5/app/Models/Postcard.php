<?php
namespace Models;
/**
 * This is the model class for postcards
 * it referes to a record in the postcards table
 *
 * @author kareem, kevin, avinash
 */

class Postcard extends Base {
    
    // Table name in database
    const TABLE = 'postcards';
    // Border style and color values
    const BORDER_NONE = 0;
    const BORDER_SOLID = 1;
    const BORDER_DASHED = 2;
    const COLOR_BLACK = 10;
    const COLOR_RED = 20;
    const COLOR_GREEN = 30;
    const COLOR_PURPLE = 40;
    const COLOR_ORANGE = 50;
    
    //primary key
    public $id;
    public $secret;
    public $image;
    public $border;
    public $wisher;
   
    /**
     *  Gets the integer identifier for a combination of style and color
     *
     *  @return void.
    */
   
    public static function getBorderValue($style, $color) {
        $keymap = array(
            'none' => self::BORDER_NONE,
            'solid' => self::BORDER_SOLID,
            'dashed' => self::BORDER_DASHED,
            'black' => self::COLOR_BLACK,
            'red' => self::COLOR_RED,
            'green' => self::COLOR_GREEN,
            'purple' => self::COLOR_PURPLE,
            'orange' => self::COLOR_ORANGE
        );
        return $keymap[$style] + $keymap[$color];
    }
  
    /**
     *  Get original values based on the stored integer value.
     *
     *  @return void.
    */

    public static function getBorder($value) {
        $reverse_keymap = array(
            self::BORDER_NONE => 'none',
            self::BORDER_SOLID => 'solid',
            self::BORDER_DASHED => 'dashed',
            self::COLOR_BLACK => 'black',
            self::COLOR_RED => 'red',
            self::COLOR_GREEN => 'green',
            self::COLOR_PURPLE => 'purple',
            self::COLOR_ORANGE => 'orange'
        );
        $style = $value % 10;
        $color = $value - $style;
        return array('color' => $reverse_keymap[$color], 'style' => $reverse_keymap[$style]);
    }
    
    // Constructs an instance, load from database if id is provided
    public function __construct($id = null) {
        parent::__construct();
        $this->id = $id;
        if (!is_null($id)) {
            $this->load();
        }
    }
   
     
    /**
     * Load data from database.
     *
     *  @return void.
    */
    public function load() {
        self::$db->where('id', $this->id);
        $row = self::$db->getOne(self::TABLE);
        if ($row) {
            foreach ($row as $key => $value) {
                $this->$key = $value;
            }
        }
    }
    
    /**
     * Stores data to database.
     * It will use UPDATE if record already exists.
     * or INSERT if it is a new record.
     *
     *  @return void.
     */
    
    public function save() {
        
        if (is_null($this->id)) {
            // perform an insert
            $this->secret = $this->generateSecretKey();
            $id = self::$db->insert(self::TABLE, $this->_getData(false));
            if (is_int($id)) {
                $this->id = $id;
            }
        } else {
            self::$db->where('id', $this->id);
            self::$db->update(self::TABLE, $this->_getData(false));
        }
    }
   
    /**
     * Returns data associated with this object as an array.
     *
     * @param string $includePrimaryKey, by default its value is set to true.
     *
     * @return array of the fields of this object.
     */
    
    private function _getData($includePrimaryKey = true) {
        
        $data = array(
            'secret' => $this->secret,
            'image' => $this->image,
            'border' => $this->border,
            'wisher' => $this->wisher
        );
        if (!$includePrimaryKey) {
            $data['id'] = $this->id;
        }
        return $data;
    }
   
    /**
     * Returns data associated with this object as an array.
     *
     * @param number $length, by default its value is set to 10.
     *
     * @return $randomString.
     */
    private function generateSecretKey($length = 10) {
        $abc = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $abcLength = strlen($abc);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $abc[rand(0, $abcLength - 1)];
        }
        return $randomString;
    }
    
    /**
     * Load an object from database, only if secret key matches.
     *
     * @return \Models\Postcard Postcard object from database
     */

    public static function lookUp($id, $secret) {
        self::connect();
        $instance = new Postcard($id);
        if (!is_null($instance)) {
            if ($instance->secret === $secret) {
                return $instance;
            }
        }
        return null;
    }
}