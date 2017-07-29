<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Http\Controllers\Web;

use Ponut\Http\Controllers\Controller;
use Ponut\Models\Option;
use Validator;
use Input;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{

    /**
     * Home Page Render
     *
     * @return string
     */
    public function indexRender()
    {
        return view('guest.home', [
            'page_title' =>  $this->option->getOption('_site_title'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }

    /**
     * 404 Page Render
     *
     * @return string
     */
    public function notfoundRender()
    {
        return view('errors.404', [
            'page_title' =>  $this->option->getOption('_site_title'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }

    /**
     * 503 Page Render
     *
     * @return string
     */
    public function errorRender()
    {
        return view('errors.503', [
            'page_title' =>  config('app.name'),
            'shared_data' => $this->getsSharedData(),
        ]);
    }

    /**
     * Test Page Render
     *
     * @return string
     */
    public function testRender($flag)
    {
        if( !in_array($flag, ['api']) ){
            return redirect('/test/api');
        }

        $output = \Route::getRoutes();
        $routes = [];
        foreach ($output as $key => $value) {
            $routes[] = $value->uri;
        }

        return view('tests.base', [
            'page_title' =>  "Test - Ponut",
            'shared_data' => $this->getsSharedData(),
            'flag' => $flag,
            'routes' => $routes
        ]);
    }

    /**
     * Job Page Render
     *
     * @return string
     */
    public function jobsRender($dept_slug = false, $job_slug = false)
    {

    }
}
