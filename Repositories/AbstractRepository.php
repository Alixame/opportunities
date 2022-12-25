<?php

namespace Alixame\Opportunities\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    /**
     * Class Constructor
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Create filter to return data of database
     *
     * @param $filters
     * @return void
     */
    public function filters($filters)
    {
        // SEPARANDO CADA FILTRO DENTRO DE UM ARRAY
        $filters = explode(';', $filters);

        // PERCORRENDO TODOS OS FILTROS NO ARRAY
        foreach ($filters as $key => $filter) {
            // PEGA UM FILTRO E SEPARA EM 3 CONDIÇÕES = COLUNA, OPERADOR E VALOR
            $conditions = explode(':', $filter);

            // VERIFICA SE O OPERADOR É LIKE
            if ($conditions[1] == 'like') {
                // SE SIM -> CONCATENA VALOR COM OS %
                $this->model = $this->model->where(
                    $conditions[0],
                    $conditions[1],
                    '%' . $conditions[2] . '%'
                );
            } else {
                // SE NÃO -> MONTA A CONDIÇÃO NORMAL
                $this->model = $this->model->where(
                    $conditions[0],
                    $conditions[1],
                    $conditions[2]
                );
            }
        }
    }

    /**
     * Create record attributes filter
     *
     * @param $attribute
     * @return void
     */
    public function attributes($attribute)
    {
        $this->model = $this->model->selectRaw($attribute);
    }

    /**
     * Create related record attributes filter
     *
     * @param $attribute
     * @return void
     */
    public function relatedRecordAttributes($attribute)
    {
        $this->model = $this->model->with($attribute);
    }

    /**
     * Mount query and return data
     *
     * @return mixed
     */
    public function getResult()
    {
        return $this->model->get();
    }

    /**
     * Mount query and return data paginate
     *
     * @param $quantity
     * @return mixed
     */
    public function getResultPaginate($quantity)
    {
        return $this->model->paginate($quantity);
    }
}