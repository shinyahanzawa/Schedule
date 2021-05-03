<?php

namespace App\Calendar;

use Carbon\Carbon;
use App\Models\Schedules;

class CalendarViewWeekly
{

	private $carbon;

	function __construct($date)
	{
		$this->carbon = new Carbon($date);
	}

	public function getdate()
	{
		return $this->carbon;
	}


	/**
	 * 次の週
	 */
	public function getNextWeek()
	{
		return $this->carbon->copy()->addWeek();
	}
	/**
	 * 前の週
	 */
	public function getPreviousWeek()
	{
		return $this->carbon->copy()->subWeek();
	}


	/**
	 * タイトル
	 */
	public function getTitle()
	{
		return $this->carbon->format('Y年n月');
	}



	public function getWeeks()
	{
		$weeks = [];

		//週初め
		$firstDay = $this->carbon->copy()->startOfWeek();

		//週末まで
		$lastDay = $this->carbon->copy()->endOfWeek();

		//週末までループさせる
		while ($firstDay < $lastDay) {
			//週カレンダーViewを作成する
			$week = new CalendarWeek($firstDay, count($weeks));
			$weeks[] = $week;
			//次の日=+1日する
			$firstDay->addDay(1);
		}
		return $weeks;
	}

	public function schedules()
	{
		return Schedules::all();
	}

	
}
