<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @method static get( string[] $array )
 * @method static inRandomOrder()
 * @method static create( array $array )
 */
class Category extends Model implements HasMedia
{
    use HasAdvancedFilter;
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public $table = 'categories';

    protected $appends = [
        'image',
    ];

    protected $orderable = [
        'id',
        'name',
        'parent.name',
    ];

    protected $filterable = [
        'id',
        'name',
        'parent.name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'parent_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function parent()
    {
        return $this->belongsTo( Category::class );
    }

    public function getImageAttribute()
    {
        return $this->getMedia( 'category_image' )->map( function( $item ) {
            $media = $item->toArray();
            $media[ 'url' ] = $item->getUrl();

            return $media;
        } );
    }

    protected function serializeDate( DateTimeInterface $date )
    {
        return $date->format( 'Y-m-d H:i:s' );
    }
}
