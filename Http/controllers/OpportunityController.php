<?php

namespace Alixame\Opportunities\Http\Controllers;

use App\Http\Controllers\Controller;
use Alixame\Opportunities\Models\Opportunity;
use Alixame\Opportunities\Http\Requests\StoreOpportunityRequest;
use Alixame\Opportunities\Http\Requests\UpdateOpportunityRequest;
use Alixame\Opportunities\Repositories\OpportunityRepository;
use Illuminate\Http\Request;

class OpportunityController extends Controller
{
    /**
     * Class Constructor
     *
     * @param Opportunity $opportunity
     */
    public function __construct(Opportunity $opportunity)
    {
        $this->opportunity = $opportunity;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // INSTANCIANDO UM OBJETO DA CLASSE REPOSITORIO
        $opportunityRepository = new OpportunityRepository($this->opportunity);

        // VERIFICANDO SE EXISTE FILTRO DE ATRIBUTOS DA RELAÇÃO NA REQUISIÇÃO
        // if ($request->has('attributes_opportunity')) {
        //     // SE SIM -> DEFINE A RELAÇÃO E OS ATRIBUTOS QUE SERÃO TRAZIDOS
        //     $relationshipAttributes = 'Opportunity:id,' . $request->attributes_opportunity;

        //     $opportunityRepository->relatedRecordAttributes($relationshipAttributes);
        // } else {
        //     // SE NÃO -> DEFINE A RELAÇÃO E TRAS TODOS OS ATRIBUTOS
        //     $opportunityRepository->relatedRecordAttributes('Opportunity');
        // }

        // VERIFICANDO SE EXISTE FILTRO NA REQUISIÇÃO
        if ($request->has('filters')) {
            $opportunityRepository->filters($request->filters);
        }

        // VERIFICANDO SE EXISTE FILTRO DE ATRIBUTOS NA REQUISIÇÃO
        if ($request->has('attributes')) {
            // SE SIM -> RETORNAR TODOS OS REGISTROS COM OS ATRIBUTOS SOLICITADOS
            $opportunityRepository->attributes($request->attributes);
        }

        // RETORNANDO DADOS DO BANCO PAGINADOS
        return response()->json(
            $opportunityRepository->getResultPaginate(10),
            200
        );
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
     * @param \App\Http\Requests\StoreOpportunityRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreOpportunityRequest $request)
    {
        // ENVIANDO DADOS PARA O BANCO
        $opportunity = $this->opportunity->create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'message' => $request->message,
            'status' => 1
        ]);

        // RETORNANDO REGISTRO CADASTRADO
        return response()->json($opportunity, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        // RECUPERANDO REGISTRO ATRAVES DO OBJETO INSTANCIADO NO METODO CONSTRUTOR
        $opportunity = $this->opportunity->find($id);

        // VERIFICANDO SE O REGISTRO BUSCADO NO BANCO EXISTE
        if (empty($opportunity)) {
            // RETORNA ERRO EM JSON
            return response()->json(['error' => 'Registro não existe'], 404);
        }

        // RETORNA A RESPONSA EM JSON
        return response()->json($opportunity, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Opportunity $opportunity
     * @return \Illuminate\Http\Response
     */
    public function edit(Opportunity $opportunity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateOpportunityRequest $request
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        // INSTANCIANDO OBJETO DO UPDATE PARA GERAR VALIDAÇÃO DINAMICA
        $requestUpdate = new UpdateOpportunityRequest();

        // RECUPERANDO REGISTRO ATRAVES DO OBJETO INSTANCIADO NO METODO CONSTRUTOR
        $opportunity = $this->opportunity->find($id);

        // VERIFICANDO SE O REGISTRO BUSCADO NO BANCO EXISTE
        if (empty($opportunity)) {
            // RETORNA ERRO EM JSON
            return response()->json(['error' => 'Registro não existe'], 404);
        }

        // VERIFICANDO SE O METODO ENVIADO É DO TIPO CORRETO PARA EFETUAR A ALTERAÇÃO E CARREGANDO DINAMICAMENTE AS REGRAS DE VALIDAÇÃO DE DADOS
        if ($request->method() === 'PATCH') {
            // DEFININDO ARRAY DAS REGRAS DINAMICAS
            $dynamicRules = [];

            // PERCORRENDO AS REGRAS DEFINIDAS NO MODEL MARCA
            foreach ($requestUpdate->rules() as $input => $rule) {
                // VERIFICANDO SE O VALOR INFORMADO POSSUI REGRA
                if (array_key_exists($input, $request->all())) {
                    $dynamicRules[$input] = $rule;
                }
            }

            // VALIDANDO DADOS - COM REGRAS DINAMICAS
            $request->validate($dynamicRules, $requestUpdate->messages());
        } else {
            // VALIDANDO DADOS
            $request->validate($requestUpdate->rules(), $requestUpdate->messages());
        }

        // TROCANDO DADOS ORIGINAIS PELOS ALTERADOS
        $opportunity->fill($request->all());

        // SALVANDO NO BANCO DE DADOS
        $opportunity->save();

        // RETORNA A RESPONSA EM JSON
        return response()->json($opportunity, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param interger $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // RECUPERANDO REGISTRO ATRAVES DO OBJETO INSTANCIADO NO METODO CONSTRUTOR
        $opportunity = $this->opportunity->find($id);

        // VERIFICANDO SE O REGISTRO BUSCADO NO BANCO EXISTE
        if (empty($opportunity)) {
            // RETORNA ERRO EM JSON
            return response()->json(['error' => 'Registro não existe'], 404);
        }

        // EXCLUINDO REGISTRO DO BANCO DE DADOS
        $opportunity->delete();

        // RETORNA A RESPONSA EM JSON
        return response()->json(['message' => 'Registro excluido com sucesso!'], 200);
    }

    public function showByStatus(int $status)
    {
        // RECUPERANDO DADOS DO BANCO
        $opportunityRepository = new OpportunityRepository($this->opportunity);

        $opportunities = $opportunityRepository->filters("status:=:$status");

        // RETORNANDO DADOS DO BANCO PAGINADOS
        return response()->json($opportunities, 200);
    }
}