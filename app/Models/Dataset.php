<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    use HasFactory;

    protected $fillable = ['category', 'firstname', 'lastname', 'email', 'gender', 'birthDate'];

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $category
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByCategory($query, $category)
    {
        if ($category) {
            return $query->where('category', $category);
        }
        return $query;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $gender
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByGender($query, $gender)
    {
        if ($gender) {
            return $query->where('gender', $gender);
        }
        return $query;
    }

    /**
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $birthDate
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByBirthDate($query, $birthDate)
    {
        if ($birthDate) {
            $age = date('Y-m-d', strtotime('-' . $birthDate . ' years'));
            return $query->where('birthDate', $age);
        }
        return $query;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int|null $minAge
     * @param int|null $maxAge
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByAgeRange($query, $minAge, $maxAge)
    {
        if ($minAge && $maxAge) {
            $minAgeDate = date('Y-m-d', strtotime('-' . $minAge . ' years'));
            $maxAgeDate = date('Y-m-d', strtotime('-' . $maxAge . ' years'));
            return $query->whereBetween('birthDate', [$maxAgeDate, $minAgeDate]);
        }
        if ($minAge) {
            $minAgeDate = date('Y-m-d', strtotime('-' . $minAge . ' years'));
            return $query->where('birthDate', '<=', $minAgeDate);
        }
        if ($maxAge) {
            $maxAgeDate = date('Y-m-d', strtotime('-' . $maxAge . ' years'));
            return $query->where('birthDate', '>=', $maxAgeDate);
        }
        return $query;
    }

}
