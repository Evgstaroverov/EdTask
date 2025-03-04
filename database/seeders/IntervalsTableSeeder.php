<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Interval;

class IntervalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		
		for ($i = 0; $i < 10000; $i++) {
			$interval = $this->GetInterval();
            Interval::create([
                'start' => $interval[0],
                'end'   => $interval[1]
            ]);
        }
        //
    }
	
	private function GetInterval(): array
    {
		$min = 0; //Миимальное значение диапазона
		$max = 1000; //максимальное значение диапазона
		$start = mt_rand($min, $max-1); //начало отрезка, макисмальное значение не входит
		$end = mt_rand($start+1, $max); // конец отрезка, минимальное значение не может быть меньше или равно началу отрезка
		$isRay = mt_rand(0, 1); //0 - отрезок, 1 - луч
		$end = $isRay ?  null : $end; // сделать отрезок лучом?
		return [$start, $end];
    }
}
