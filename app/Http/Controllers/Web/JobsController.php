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


class JobsController extends Controller
{

    /**
     * Jobs List Page
     *
     * @return string
     */
    public function jobsList()
    {
        return view('admin.jobs-all', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }

    /**
     * Jobs Add Page
     *
     * @return string
     */
    public function addJob()
    {
        return view('admin.jobs-add', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }

    /**
     * Jobs Edit Page
     *
     * @param integer $id
     * @return string
     */
    public function editJob($id)
    {
        return view('admin.jobs-edit', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }

    /**
     * Jobs View Page
     *
     * @param integer $id
     * @return string
     */
    public function viewJob($id)
    {
        return view('admin.jobs-view', [
            'page_title' =>  $this->option->getOption('_site_title')
        ]);
    }
}
