<?php

namespace Modules\Article\Models\Presenters;

use Carbon\Carbon;
use Illuminate\Support\Str;

trait PostPresenter
{
    /**
     * Get the featured image attribute.
     *
     * @param  mixed  $value  The value of the featured image attribute.
     * @return string The modified featured image URL.
     */
    public function getFeaturedImageAttribute($value)
    {
        $featured_image = $value;

        if (Str::startsWith($featured_image, 'https://picsum.photos')) {
            $return_text = $featured_image.'?random='.$this->id;
        } else {
            $return_text = $featured_image;
        }

        return $return_text;
    }

    /**
     * Get the formatted created_at attribute.
     *
     * @return string
     */
    public function getPublishedAtFormattedAttribute()
    {
        $diff = Carbon::now()->diffInHours($this->created_at);

        if ($diff < 24) {
            return $this->created_at->diffForHumans();
        }

        return $this->created_at->isoFormat('llll');
    }

    public function getStatusFormattedAttribute()
    {
        switch ($this->status) {
            case '0':
                return '<span class="badge bg-danger">'.__("Unpublished").'</span>';
                break;

            case '1':
                if ($this->created_at >= Carbon::now()) {
                    return '<span class="badge bg-warning text-dark">'.__("Scheduled").' ('.$this->created_at_formatted.')</span>';
                }

                return '<span class="badge bg-success">'.__("Pubished").'</span>';
                break;

            case '2':
                return '<span class="badge bg-info">'.__("Draft").'</span>';
                break;

            default:
                return '<span class="badge bg-primary">'.__("Status").':'.$this->status.'</span>';
                break;
        }
    }
}
