<?php

namespace App\Imports;

use App\Models\Member;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MembersImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        //ambil header dan masukin ke variable dulu
        $keys= array();
        foreach ($rows[0] as $item) {
            array_push($keys, $item);
        }
        
        //hilangin header dari rows
        unset($rows[0]);

        // $result = array();

        //untuk setiap baris
        foreach ($rows as $row) {
            $member = array();   
            //kasih header tiap baris
            for ($i=0; $i < count($row) ; $i++) { 
                $member[$keys[$i]] = $row[$i];
            }
            // $encode_member_data = json_encode($member);
            // array_push($result, $member);
            Member::create([
                // 'data' => $encode_member_data,
                'data' => $member,
            ]);
        }
    }
}
