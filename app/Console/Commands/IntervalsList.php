<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class IntervalsList extends Command
{
    /**
     * Имя и сигнатура консольной команды.
     *
     * @var string
     */
    protected $signature = 'intervals:list 
                            {--left= : Левая граница интервала}
                            {--right= : Правая граница интервала}';

    /**
     * Описание консольной команды.
     *
     * @var string
     */
    protected $description = 'Выводит интервалы, пересекающиеся с заданным интервалом [N, M]';

    /**
     * Выполнение консольной команды.
     *
     * @return int
     */
    public function handle()
    {
        // Валидация входных данных
        $validator = Validator::make([
            'left'  => $this->option('left'),
            'right' => $this->option('right'),
        ], [
            'left'  => 'required|integer',
            'right' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $this->error('Ошибка валидации:');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1; // Возвращаем код ошибки
        }

        $left  = (int) $this->option('left');
        $right = (int) $this->option('right');

        // Получаем интервалы
        $intervals = $this->getIntersectingIntervals($left, $right);

        // Выводим результат
        $this->displayIntervals($intervals);

        return 0; // Успешное завершение
    }

    /**
     * Получает интервалы, пересекающиеся с заданным интервалом [N, M].
     *
     * @param int $left
     * @param int $right
     * @return \Illuminate\Support\Collection
     */
    protected function getIntersectingIntervals(int $left, int $right)
    {
        return DB::table('intervals')
            ->where('start', '<=', $right)
            ->where(function ($query) use ($left) {
                $query->where('end', '>=', $left)
                      ->orWhereNull('end');
            })
            ->get();
    }

    /**
     * Выводит интервалы в виде таблицы.
     *
     * @param \Illuminate\Support\Collection $intervals
     * @return void
     */
    protected function displayIntervals($intervals)
    {
        if ($intervals->isEmpty()) {
            $this->info('Нет интервалов, пересекающихся с заданным диапазоном.');
            return;
        }

        // Преобразуем коллекцию в массив для вывода
        $tableData = $intervals->map(function ($interval) {
            return [
                'ID'    => $interval->id,
                'Start' => $interval->start,
                'End'   => $interval->end ?? 'NULL', // Если end равен NULL, выводим 'NULL'
            ];
        });

        // Выводим таблицу
        $this->table(['ID', 'Start', 'End'], $tableData);
    }
}