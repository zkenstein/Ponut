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

use Validator;
use Input;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class DashboardController extends Controller
{

    /**
     * Dashboard Analytics Page
     *
     * @return string
     */
    public function dashboard()
    {
        return view('admin.dashboard', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }
}