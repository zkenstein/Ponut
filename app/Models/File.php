<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    public $timestamps = true;

    public function __construct()
    {
        $this->table = env('DB_TABLES_PREFIX', '') . $this->table;
    }
}

