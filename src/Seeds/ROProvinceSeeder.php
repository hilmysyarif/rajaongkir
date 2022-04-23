<?php

namespace Dipantry\Rajaongkir\Seeds;

use Dipantry\Rajaongkir\Helper\SystemSecurity;
use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;

class ROProvinceSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = config('rajaongkir.table_prefix').'provinces';
        $this->filename = dirname(__FILE__, 2) . '../../resources/csv/province.csv';
        $this->csv_delimiter = ',';
        $this->offset_rows = 1;
        $this->mapping = [
            0 => 'id',
            1 => 'name'
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!SystemSecurity::allowProvinceSeeding()){
            return;
        }

        DB::disableQueryLog();
        DB::table($this->table);

        parent::run();
    }
}