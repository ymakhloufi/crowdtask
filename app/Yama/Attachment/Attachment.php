<?php

namespace Yama\Attachment;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Yama\Attachment\Attachment
 *
 * @property int               $id
 * @property int               $attachable_id
 * @property string            $attachable_type
 * @property string            $filename
 * @property string            $filetype
 * @property Carbon            $created_at
 * @property Carbon            $updated_at
 * @property Carbon            $deleted_at
 */
class Attachment extends Model
{
    
    protected $fillable = ['filename', 'filetype'];
    
    
    public function attachable()
    {
        return $this->morphTo();
    }
    
}
