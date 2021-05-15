<?php
namespace App\Exceptions;

use Exception;

class InsufficientRoleException extends Exception {
    /**
     * @var string
    */
    public $ownedRole;

    /**
     * @var string
    */
    public $wantedRole;

    public function __construct(string $ownedRole, string $wantedRole) {
        $this->ownedRole = $ownedRole;
        $this->wantedRole = $wantedRole;
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        if($request->expectsJson()) {
            return $request->json([
                'error' => 'InsufficientRoleException',
                'ownedRole' => $this->ownedRole,
                'wantedRole' => $this->wantedRole,
            ], 401);
        } else {
            return view('errors.401', ['message' => 'Non hai il ruolo sufficente per vedere questa pagina.']);
        }
    }
}
