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

            $table['data'] = $this->formData($table['data']->toArray(), $table['columns']);
        }

        return $data;
    }

    private function checkColumns(array &$table) :array
    {
        $columns = $table['columns'];
        foreach($columns as $key => $column) {
            if(is_array($column)) {
                $push = $column;
                unset($columns[$key]);

                array_push($columns, ...$push);
            }
        }

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

        if(isset($params['filters'])) {
            $query = $this->applyQueryFilters($query, $params['filters'], $table);
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

    private function applyQueryFilters($query, array $filters, array &$table)
    {
        foreach($filters as $filter_column => $filter) {
            $table_column_name = $filter_column;
            if(isset($table['columns'][$filter_column]) && is_string($table['columns'][$filter_column])) {
                $table_column_name = $table['columns'][$filter_column];
            }

            if(is_array($filter)) {
                $query->where(function($q) use($table_column_name, $filter, &$table) {
                    $i = 0;
                    foreach($filter as $f_name => $f_value) {
                        if(is_array($f_value)) {
                            if(Schema::connection('mysql')->hasColumn($table['name'], $f_name)) {
                                if($i > 0) {
                                    $q->orWhereIn($f_name, $f_value);
                                } else {
                                    $q->whereIn($f_name, $f_value);
                                }
                            } elseif(Schema::connection('mysql')->hasColumn($table['name'], $table_column_name)) {
                                if($i > 0) {
                                    $q->orWhereIn($table_column_name . '->' . $f_name, $f_value);
                                } else {
                                    $q->whereIn($table_column_name . '->' . $f_name, $f_value);
                                }
                            } else {
                                $table['errors'][] = trans('adpanel_connector::main.error.filter') . ' ' . trans('adpanel_connector::main.error.no_columns', [
                                    'columns' => $table_column_name . ', ' . $table_column_name . '->' . $f_name,
                                    'table' => $table['name'],
                                ]);
                            }
                        } else {
                            if(Schema::connection('mysql')->hasColumn($table['name'], $f_name)) {
                                if($i > 0) {
                                    $q->orWhere($f_name, $f_value);
                                } else {
                                    $q->where($f_name, $f_value);
                                }
                            } elseif(Schema::connection('mysql')->hasColumn($table['name'], $table_column_name)) {
                                if($i > 0) {
                                    $q->orWhere($table_column_name . '->' . $f_name, $f_value);
                                } else {
                                    $q->where($table_column_name . '->' . $f_name, $f_value);
                                }
                            } else {
                                $table['errors'][] = trans('adpanel_connector::main.error.filter') . ' ' . trans('adpanel_connector::main.error.no_columns', [
                                    'columns' => $table_column_name . ', ' . $table_column_name . '->' . $f_name,
                                    'table' => $table['name'],
                                ]);
                            }
                        }

                        $i++;
                    }
                });
            } elseif(Schema::connection('mysql')->hasColumn($table['name'], $table_column_name)) {
                $query->where($table_column_name, $filter);
            } else {
                $table['errors'][] = trans('adpanel_connector::main.error.no_column', [
                    'column' => $table_column_name,
                    'table' => $table['name'],
                ]);
            }
        }

        return $query;
    }

    private function formData(array $data, array $columns) :array
    {
        $formatted_data = [];
        
        foreach($data as $row) {
            $formatted_data[] = $this->formRowData($row, $columns);
        }

        return $formatted_data;
    }
    
    private function formRowData($data, array $columns) :array
    {
        $formatted_row = [];
        
        foreach($columns as $column_name => $column) {
            if(is_array($column)) {
                $col_array = [];
                foreach($column as $col) {
                    if(! empty($data->{$col})) {
                        $col_array[$col] = $data->{$col};
                    }
                }
                
                $formatted_row[$column_name] = $col_array;
            } else {

                if(! is_numeric($column_name)) {
                    $formatted_row[$column_name] = $data->{$column};
                } else {
                    $formatted_row[$column] = $data->{$column};
                }

            }
        }
        
        return $formatted_row;
    }
}
