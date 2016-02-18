<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use CodeProject\Repositories\ProjectRepositoryEloquent;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use Illuminate\Database\Eloquent\QueryException as QueryException;


class ProjectFileController extends Controller
{

    private $repository;
    private $service;

    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectRepository $repository)
    {
        return $this->repository->findWhere(['owner_id'=>Authorizer::getResourceOwnerId()]);
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        $data['file'] = $file;
        $data['extension'] = $extension;
        $data['name'] = $request->name;
        $data['project_id'] = $request->project_id;
        $data['description'] = $request->description;

        $this->service->createFile($data);
        return response()->json(['success' => 'Arquivo enviado com sucesso.']);
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
            if($this->checkProjectPermissions($id)==false){
            return ['error' => 'Access Forbidden'];
            }        
                return $this->repository->find($id);
        }catch (ModelNotFoundException $e){
            return ['error'=>true, 'msg' => 'Projeto nao encontrado.'];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $noteId)
    {
       try{
           if($this->checkProjectOwner($id)==false){
                return ['error' => 'Access Forbidden'];
            } 
           return $this->repository->find($id)->update($request->all());
       }catch (ModelNotFoundException $e){
            return ['error'=>true, 'msg' => 'Projeto nao encontrado.'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $noteId)
    {
        try{
            if($this->checkProjectOwner($id)==false){
                return ['error' => 'Access Forbidden'];
            }

            return $this->repository->delete($noteId);
        }catch (ModelNotFoundException $e){
            return ['error'=>true, 'msg' => 'Arquivo nao encontrado.'];
        }catch (QueryException $e) {
            return ['error'=>true, 'Arquivo não pode ser apagado pois existe um ou mais projetos vinculados a ele.'];
        } 
    }

    private function checkProjectOwner($projectId){

        $userId = Authorizer::getResourceOwnerId();
        
        return $this->repository->isOwner($projectId, $userId);
    }

    private function checkProjectMember($projectId){

        $userId = Authorizer::getResourceOwnerId();
        
        return $this->repository->hasMember($projectId, $userId);
    }

    private function checkProjectPermissions($projectId){
        if($this->checkProjectOwner($projectId) or $this->checkProjectMember($projectId)){
            return true;
        }
        return false;
    }
}
