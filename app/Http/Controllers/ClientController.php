<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Repositories\ClientRepository;
use CodeProject\Services\ClientService;

use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use Illuminate\Database\Eloquent\QueryException as QueryException;

class ClientController extends Controller
{

    private $repository;
    private $service;

    public function __construct(ClientRepository $repository, ClientService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ClientRepository $repository)
    {
        return $this->repository->all();
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
    public function show($id)
    {
        try{
            return $this->repository->find($id);            
        }catch (ModelNotFoundException $e){
            return ['error'=>true, 'msg' => 'Cliente nao encontrado.'];
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
           $this->repository->find($id)->update($request->all()); 
           return response()->json(['success' => 'Cliente Atualizado com Sucesso']);        
       }catch (ModelNotFoundException $e){
            return ['error'=>true, 'msg' => 'Cliente nao encontrado.'];
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
            return ['error'=>true, 'msg' => 'Cliente nao encontrado.'];
        }catch (QueryException $e) {
            return ['error'=>true, 'Cliente não pode ser apagado pois existe um ou mais projetos vinculados a ele.'];
        } 
    }
}
