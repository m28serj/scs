<?php namespace App;

class Date extends \M28Serj\Date\Date {
		public function checkDate($offsetNextDay, $holidays){
				if($this->isWeekend() || $holidays->has($this->day.'.'.$this->month)){
						if($offsetNextDay){
								$this->addDay();
								return $this->checkDate($offsetNextDay, $holidays);
						} else {
								$this->subDay();
								return $this->checkDate($offsetNextDay, $holidays);
						}
				}
				else {
						return $this;
				}
		}
}
