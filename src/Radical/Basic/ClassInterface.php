<?php
namespace Radical\Basic;

abstract class ClassInterface  {
	const CLASS_BASE = '';
	const fieldType = 'const';
	
	static function fromId($id){
		if(is_array($id)) $id = implode('\\',$id);
		$class = static::CLASS_BASE.'\\'.$id;
		if(class_exists($class)){
			return new $class();
		}
	}
	static function fromField(array $fields){
		foreach(static::getAll() as $class){
			if(static::fieldType == 'const'){
				$ok = true;
				foreach($fields as $field=>$value){
					if(constant($class.'::'.$field) != $value){
						$ok = false;
						break;
					}
				}
				if($ok){
					return new $class();
				}
			}
		}
	}
	static function getAll(){
		return \Radical\Core\Libraries::get(static::CLASS_BASE.'\\*');
	}
}