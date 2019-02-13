<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Documents
 * @package App\Models
 */
class Documents extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    public $table = 'documents';

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    public $fillable = [
        'attachment',
        'preview'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'attachment' => 'string',
        'preview' => 'string'
    ];

    /**
     * Validation rules for creating documents
     *
     * @var array
     */
    public static $rules = [
        'attachment' => 'required',
        'preview' => 'required'
    ];

    /**
     * Validation rules for creating documents
     *
     * @var array
     */
    public static $fileUploadRules = [
        'pdf' => 'required|file|mimes:pdf'
    ];
}
