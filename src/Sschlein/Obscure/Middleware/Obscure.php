<?php namespace Sschlein\Obscure\Middleware;

use Closure;
use Illuminate\Routing\Route;
use Hashids\Hashids;

class Obscure
{
    /**
     * @var Route
     */
    protected $route;

    /**
     * @param Route $route
     */
    public function __construct( Route $route)
    {
        $this->route = $route;
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
        $hashids = new Hashids(config('obscure.salt'), config('obscure.length'), config('obscure.alphabet'));

        // decode form request hashs
        if($request->request->has('id'))
        {
            $request->request->add(['id' => $hashids->decode($request->request->get('id'))[0]]);
        }

        // decode route hashs
        if ($this->route->parameter('id'))
        {
            $this->route->setParameter('id', $hashids->decode($this->route->parameter("id" ))[0]);
        }

        return $next($request);
    }
}
