<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\OperadoraRequest;
use App\Http\Resources\OperadoraResource;
use App\Models\Operadora;
use App\Models\Status;
use Exception;
use Facade\FlareClient\Http\Response;
use Illuminate\Contracts\Validation\Rule as ValidationRule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseStatusCodeSame;

class OperadoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $response = array();
            $response['operadoras'] = Operadora::all();
            $response['campos']['operadoras'] = Operadora::all();
            $response['campos']['status'] = Status::all();
            return (new OperadoraResource($response))->response()->setStatusCode(200);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OperadoraRequest $request)
    {
        try {
            $operadora = new Operadora();
            $operadora->no_operadora = $request->no_operadora;
            $operadora->de_operadora = $request->de_operadora;
            $operadora->id_status = $request->id_status;
            $operadora->save();
            return response()->json(new OperadoraResource(['message' => 'Operadora cadastrada com sucesso!']));
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $operadora = Operadora::find($id);
            return response()->json(new OperadoraResource($operadora));
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OperadoraRequest $request, $id)
    {
        try {
            $operadora = Operadora::find($id);
            if ($operadora) {
                $operadora->no_operadora = $request->no_operadora;
                $operadora->de_operadora = $request->de_operadora;
                $operadora->id_status = $request->id_status;
                $operadora->save();
                return response()->json(new OperadoraResource(['message' => 'Operadora atualizada com sucesso!']));
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        dd($request);
        try {
            // $operadora = Operadora::find($id)->delete();
            // if ($operadora)
                return response()->json(new OperadoraResource(['message' => 'Operadora excluída com sucesso!']));
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function search(Request $request)
    {
        try {
            $query = Operadora::join('status', 'operadoras.id_status', '=', 'status.id');

            if ($request->filled('id')) {
                $query->where('operadoras.id', $request->id);
            }

            if ($request->filled('id_status')) {
                $query->where('operadoras.id_status', $request->id_status);
            }

            $operadoras = $query->get();
            return response()->json(new OperadoraResource($operadoras));
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
