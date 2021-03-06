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


class PluginsController extends Controller
{

    /**
     * Plugins Page
     *
     * @return string
     */
    public function plugins()
    {
        return view('admin.plugins', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }
}
