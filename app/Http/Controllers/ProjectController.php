<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use CodeProject\Repositories\ProjectRepositoryEloquent;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProjectController extends Controller
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
        if($this->checkProjectPermissions($id)==false){
            return ['error' => 'Access Forbidden'];
        }
        return $this->repository->find($id);
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
       if($this->checkProjectOwner($id)==false){
            return ['error' => 'Access Forbidden'];
        } 
       return $this->repository->find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $noteId)
    {
        if($this->checkProjectOwner($id)==false){
            return ['error' => 'Access Forbidden'];
        }

        return $this->repository->delete($noteId);
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
