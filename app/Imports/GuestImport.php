<?php

namespace App\Imports;


use App\Http\Requests\AdminGuest;
use App\Http\Requests\ImportGuest;
use App\Models\Guest;
use App\Models\GuestTime;
use App\Models\GuestTimeLog;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;

class GuestImport implements ToCollection
{
    protected ImportGuest $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection(Collection $rows)
    {

        $rows->forget(0);


        foreach ($rows as $row) {
            $checkGuest = Guest::where('passport', $row[1]);
            if ($checkGuest->exists()) {

                $guestEdit = $checkGuest->first();
                $guestEdit->update([
                    'name' => $row[0],
                    'passport' => $row[1],
                    'user_id' => Auth::id(),
                    'room' => null,
                    'room_type' => $this->request->room_type,
                    'phone' => $row[2],
                    'location' => $this->request->location,
                    'status' => 2,
                    'vouchers' => Guest::stringVouchers([$this->request->breakfast, $this->request->lunch, $this->request->supper])
                ]);
                $guestTime = GuestTime::where(['guest_id' => $guestEdit->id,])->first();
                $guestTime->update([
                    'entry' => $this->request->entry,
                    'departure' => $this->request->departure,
                ]);
                GuestTimeLog::create([
                    'guest_id' => $guestEdit->id,
                    'entry' => $guestTime->entry,
                    'departure' => $guestTime->departure
                ]);
            } else {
                $guest = Guest::create([
                    'name' => $row[0],
                    'passport' => $row[1],
                    'user_id' => Auth::id(),
                    'room' => null,
                    'room_type' => $this->request->room_type,
                    'phone' => $row[2],
                    'location' => $this->request->location,
                    'status' => 2,
                    'vouchers' => Guest::stringVouchers([$this->request->breakfast, $this->request->lunch, $this->request->supper])
                ]);

                $guestTime = GuestTime::create([
                    'guest_id' => $guest->id,
                    'entry' => $this->request->entry,
                    'departure' => $this->request->departure,
                ]);
                GuestTimeLog::create([
                    'guest_id' => $guest->id,
                    'entry' => $guestTime->entry,
                    'departure' => $guestTime->departure
                ]);

            }


        }

    }


    private function checkImport($file)
    {
        /** $data = $this->fetchFromExcel($file);
         * $errors = '';
         * $labels = ['fullname', 'passport', 'phone'];
         *
         * if($this->checkExcelLabels($data[0], $labels)){
         * $errors = "Данные не соответсвуют образцу<br>";
         * return $errors;
         * }
         *
         * $count = 2;
         * unset($data[0]); //Remove frist line since it's not a data but labels
         * foreach($data as $d)
         * {
         * if($d[0] == '') $errors .= "Линия ".$count.": Некорректный ФИО<br>";
         * if(!$this->checkPassport($d[1])) $errors .= "Линия ".$count.": Некорректный ИИН <br>";
         * if($this->findByPassport($d[1])) $errors .= "Линия ".$count.": Гость с таким ИИН уже есть в базе<br>";
         * if($d[2] == '') $errors .= "Линия ".$count.": Введите номер телефона<br>";
         * $count++;
         * }
         *
         * return $errors;**/
    }
}
