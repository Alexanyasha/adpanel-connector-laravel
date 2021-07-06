<?php

namespace DesignCoda\AdpanelConnector;

use DB;
use Illuminate\Support\Facades\Schema;

class AdpanelConnector
{
    protected $tables = [];

    public function __construct() {
        $config = config('adpanel_connector.tables') ?? [];

        foreach($config as $table_name => $columns) {
            $this->tables[] = [
                'name' => $table_name,
                'columns' => $columns,
            ];
        }
    }

    public function getData(array $params = []) :array
    {
        $data = $this->tables;

        foreach($data as &$table) {
            $columns = $this->checkColumns($table);
            $temp_data = $this->buildQuery($table, $columns, $params);

            try {
                
                $table['data'] = $temp_data->get();  

            } catch (\Exception $e) {
                $table['data'] = null;
                logger($e->getFile() . ' ' . $e->getLine() . ': ' . $e->getMessage());
            }
        }

        return $data;
    }

    private function checkColumns(array &$table) :array
    {
        $columns = $table['columns'];
        foreach($columns as $key => $column) {
            if(! Schema::connection('mysql')->hasColumn($table['name'], $column)) {
                $table['errors'][] = trans('adpanel_connector::main.error.no_column', [
                    'column' => $column,
                    'table' => $table['name'],
                ]);
                unset($columns[$key]);
            }
        }

        return $columns;
    }

    private function buildQuery(array &$table, array $columns, array $params)
    {
        $query = DB::table($table['name'])->select($columns);
        
        if(isset($params['from'])) {
            $query->where('created_at', '>', date('Y-m-d H:i:s', strtotime($params['from'])));
        }

        if(isset($params['to'])) {
            $query->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($params['to'])));
        }

        if(isset($params['order_by'])) {
            if(! Schema::connection('mysql')->hasColumn($table['name'], $params['order_by'])) {
                $table['errors'][] = trans('adpanel_connector::main.error.no_column', [
                    'column' => $params['order_by'],
                    'table' => $table['name'],
                ]);
            } else {
                $query->orderBy($params['order_by'], (isset($params['desc']) && $params['desc'] == true ? 'desc' : 'asc'));
            }
        }

        return $query;
    }
    
}
