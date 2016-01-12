<?php

namespace CodeProject\Http\Middleware;

use Closure;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Repositories\ProjectRepositoryEloquent;

class CheckProjectOwner
{
    public function __construct(ProjectRepository $repository){
        $this->repository = $repository;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

       

        return $next($request);
    }
}
