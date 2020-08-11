<?php
namespace App\Http\Middleware;
use Closure;

class HeadersSeguros
{
    // Podrías checar la siguiente página para más información acerca de estas cabeceras
    // https://securityheaders.com/

    // Lista las cabeceras que no quieras en tus respuestas de tu aplicación
    // Hay cabeceras que no es recomendable que se muestren, por ejemplo "X-Powered-BY" muestra información del servidor, la puedes editar a tu gusto
    private $headersNoAdmitidos = [
        'X-Powered-By',
        'Server',
    ];
    public function handle($request, Closure $next)
    {
        $this->removerCabecerasNoAdmitidas($this->headersNoAdmitidos);
        $response = $next($request);
        $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('Strict-Transport-Security', 'max-age:31536000; includeSubDomains');
       // $response->headers->set('Content-Security-Policy', "style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline'"); // Esta cabecera si depende mucho de tu aplicación (Leer más después del código)
        return $response;
    }
    private function removerCabecerasNoAdmitidas($listaCabeceras)
    {
        foreach ($listaCabeceras as $cabecera)
            header_remove($cabecera);
    }
}
