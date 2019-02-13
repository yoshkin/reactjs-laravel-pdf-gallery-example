<?php

namespace App\Repositories;

use App\Models\Documents;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DocumentsRepository
 * @package App\Repositories
 * @version February 2, 2019, 4:10 pm UTC
 *
 * @method Documents findWithoutFail($id, $columns = ['*'])
 * @method Documents find($id, $columns = ['*'])
 * @method Documents first($columns = ['*'])
*/
class DocumentsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'attachment',
        'preview'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Documents::class;
    }
}
