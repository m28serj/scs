<?php namespace App;

class Date extends \M28Serj\Date\Date {
		public function checkDate($offsetNextDay, $holidays){
				if($this->isWeekend() || $holidays->has($this->day.'.'.$this->month)){
						if($offsetNextDay){
								return $this->addDay()->checkDate($offsetNextDay, $holidays);
						} else {
								return $this->subDay()->checkDate($offsetNextDay, $holidays);
						}
				} else {
						return $this;
				}
		}
}
