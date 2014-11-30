<?php
class Product extends Eloquent{
	protected $guarded = array(
        'id'
    );

    protected $table = 'products';

    public $timestamps = false;

    public static function multi_menu(){
    	return DB::table('fs_menu')
                    ->where('id_parent','NULL')
                    ->orderBy('Id')
                    ->take(12)
                    ->get();
    } 

    public static function get_all_product(){
        return DB::table('fs_product')
                    ->orderBy('Id','desc')
                    ->take(6)
                    ->get();
    }

    public static function get_men_product(){
        return DB::table('fs_product')
                    ->join('fs_menu','fs_product.Id_menu','=','fs_menu.Id')
                    ->whereIn('fs_product.Id_menu',function($query){
                        $query->select('Id')
                                    ->from('fs_menu')
                                    ->where('Id_parent',4)
                                    ->get();
                    })
                    ->get();
    }

    public static function get_woman_product(){
        return DB::table('fs_product')
                    ->join('fs_menu','fs_product.Id_menu','=','fs_menu.Id')
                    ->whereIn('fs_product.Id_menu',function($query){
                        $query->select('Id')
                                            ->from('fs_menu')
                                            ->where('Id_parent',1)
                                            ->get();
                    })
                    ->get();
    }

    public static function get_feature_product(){
        return DB::table('fs_product')->where('Feature',1)->get();
    }
}
