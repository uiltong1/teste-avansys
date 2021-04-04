<?php

namespace App\Services\Contracts;

use App\Models\Operadora;
use App\Models\Status;

class FieldsServices
{
    public static function getFieldStatus()
    {
        $status = Status::all();

        foreach ($status as $value)
            $field[] = [
                'id' => $value->id,
                'no_status' => $value->no_status,
            ];

        $field[] = [
            'id' => null,
            'no_status' => 'Todos'
        ];
        return $field;
    }

    public static function getFieldOperadoras()
    {
        $operadoras = Operadora::all();

        foreach ($operadoras as $operadora)
            $field[] = [
                'id' => $operadora->id,
                'no_operadora' => $operadora->no_operadora,
            ];

        $field[] = [
            'id' => null,
            'no_operadora' => 'Todos'
        ];
        return $field;
    }
}
