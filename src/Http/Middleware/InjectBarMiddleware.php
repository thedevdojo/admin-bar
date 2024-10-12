<?php

namespace Wave\Plugins\AdminBar\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InjectBarMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->guest()) {
            return $next($request);
        } else {
            $cornerTabHTML = view('admin-bar::index')->render();
            
            $response = $next($request);
            $content = $response->getContent();
            
            // Inject $cornerTabHTML inside the <body> tag
            $content = preg_replace('/(<body[^>]*>)(.*?)(<\/body>)/s', '$1$2' . $cornerTabHTML . '$3', $content);
            // dd($content);
            return $response->setContent($content);
        }
        
        //return $next($request);
    }
}
