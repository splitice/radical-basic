<?php
namespace Radical\Basic\DateTime;

use Radical\Database\IToSQL;
use Radical\DB;

abstract class DateTimeShared extends Timestamp implements IToSQL {
	const DATABASE_FORMAT = "";
	
	function getDay(){
		return (int)$this->toFormat('j');
	}
	function getMonth(){
		return (int)$this->toFormat('n');
	}
	function getYear(){
		return (int)$this->toFormat('Y');
	}
	
	static function fromSQL($d) {
		return new static(strtotime ( $d ));
	}

    function toSQL(){
        return DB::e($this->toSQLFormat());
    }
	
	function toSQLFormat() {
		return $this->toFormat ( static::DATABASE_FORMAT );
	}
}