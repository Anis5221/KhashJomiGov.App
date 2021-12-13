<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BondobostoApp extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function union () {
        return $this->belongsTo(Union::class, 'main_union_id', 'id');
    }

    public function upa_zila () {
        return $this->belongsTo(UpaZila::class, 'main_upzila_id', 'id');
    }

    public function explodedData ($attribute) {
        
        return explode(',', $this->$attribute);
    }

    public function familyMembers() {
        $familys = array();

        foreach($this->explodedData('shodosso_names') as $item) {
            $ar1[] = [
                'name' => $item??'',
            ];
        }
        foreach($this->explodedData('shodosso_ages') as $item) {
            $ar2[] = [
                'age' => $item??'',
            ];
        }
        foreach($this->explodedData('shodosso_relations') as $item) {
            $ar3[] = [
                'relation' => $item??'',
            ];
        }
        foreach($this->explodedData('shodosso_whatdos') as $item) {
            $ar4[] = [
                'whatdos' => $item??'',
            ];
        }
        foreach($this->explodedData('shodosso_comments') as $item) {
            $ar5[] = [
                'comment' => $item??'',
            ];
        }
        for($i=0; $i<count($ar1); $i++) {
            $familys[] = [
                'name' => $ar1[$i]['name']??'',
                'age' => $ar2[$i]['age']??'',
                'relation' => $ar3[$i]['relation']??'',
                'whatdos' => $ar4[$i]['whatdos']??'',
                'comment' => $ar5[$i]['comment']??'',
            ];
        }

        return $familys;

    }
}