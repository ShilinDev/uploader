<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *  definition="Image",
 *  @SWG\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="filename",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="mime",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="original_filename",
 *      type="string"
 *  )
 * )
 */
class Image extends Model
{
    protected $fillable = ['filename'];
}
