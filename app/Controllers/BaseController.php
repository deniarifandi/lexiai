<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 *
 * Extend this class in any new controllers:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */

    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Load here all helpers you want to be available in your controllers that extend BaseController.
        // Caution: Do not put the this below the parent::initController() call below.
        // $this->helpers = ['form', 'url'];

        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        // $this->session = service('session');

        if (! session()->get('logged_in')) {

    if (isset($_COOKIE['remember_me'])) {

        [$selector, $token] = explode(':', $_COOKIE['remember_me']);

        $db = db_connect();

        $remember = $db->table('user_remember_tokens')
            ->where('selector', $selector)
            ->get()
            ->getRowArray();

        if (
            $remember &&
            strtotime($remember['expires_at']) > time() &&
            hash_equals(
                $remember['token_hash'],
                hash('sha256', $token)
            )
        ) {

            $user = $db->table('users')
                ->where('id', $remember['user_id'])
                ->get()
                ->getRowArray();

            if ($user) {

                session()->regenerate();

                session()->set([
                    'user_id'   => $user['id'],
                    'username'  => $user['username'],
                    'logged_in' => true,
                ]);
            }
        }
    }
}
    }
}
