<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Services\ProjectTaskService;
use CodeProject\Repositories\ProjectTaskRepository;

use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use Illuminate\Database\Eloquent\QueryException as QueryException;


class ProjectTaskController extends Controller
{

    private $repository;
    private $service;

    public function __construct(ProjectTaskRepository $repository, ProjectTaskService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        try{
            return $this->repository->findWhere(['project_id' => $id]);
        }catch (ModelNotFoundException $e){
            return ['error'=>true, 'msg' => 'Projeto nao encontrado.'];
        }
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $taskId)
    {
        try{
            return $this->repository->findWhere(['project_id' => $id, 'id' => $taskId]);            
        }catch (ModelNotFoundException $e){
            return ['error'=>true, 'msg' => 'Tarefa nao encontrada.'];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       try{
            return $this->repository->find($id)->update($request->all());
            return response()->json(['success' => 'Tarefa Atualizada com Sucesso']);        
       }catch (ModelNotFoundException $e){
            return ['error'=>true, 'msg' => 'Tarefa nao encontrada.'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
        $this->repository->find($id)->delete();
        return response()->json(['success' => 'Registro apagado com Sucesso']);
        }catch (ModelNotFoundException $e){
            return ['error'=>true, 'msg' => 'Tarefa nao encontrada.'];
        }catch (QueryException $e) {
            return ['error'=>true, 'Tarefa não pode ser apagado pois existe um ou mais projetos vinculados a ela.'];
        }            
    }
}
