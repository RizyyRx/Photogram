<?
/**
 * ACCESS SPECIFIERS,
 * public
 * private
 * protected
 */
class Mic{
    public $brand;
    public $colour;
    public $light;
    private $model;
    public $price;

    public function __call($name,$arguments){
        print("call is here...dont worry\n");
        print($name."\n");
        print_r($arguments);
    }

    public function __construct()
    {
        print("construction done...\n");
    }

    public function setLight($light){
        print($light);
        print($this->light);
    }
    public function setModel($model){
        $this->model=$model;
    }
    public function getModel(){
        print($this->model);
    }
}
?>