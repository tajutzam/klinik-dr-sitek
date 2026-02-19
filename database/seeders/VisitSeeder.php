<?php

namespace Database\Seeders;

use App\Models\Medicine;
use App\Models\Patient;
use App\Models\User;
use App\Models\Visit;
use App\Models\VisitMedicine;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $patients = Patient::all();
        $users = User::all();
        $medicines = Medicine::all();

        if ($patients->isEmpty() || $users->isEmpty() || $medicines->isEmpty()) {
            return;
        }

        for ($i = 0; $i < 100; $i++) {

            DB::beginTransaction();

            try {

                $patient = $patients->random();
                $user = $users->random();

                $visitDate = Carbon::now()
                    ->subDays(rand(0, 30))
                    ->setTime(rand(8, 17), rand(0, 59));

                $doctorFee = rand(50000, 150000);
                $additionalFee = rand(0, 50000);

                $visit = Visit::create([
                    'patient_id' => $patient->id,
                    'created_by' => $user->id,
                    'visit_date' => $visitDate,
                    'complaints' => 'Demam dan batuk',
                    'diagnosis' => 'Infeksi saluran pernapasan ringan',
                    'treatment' => 'Istirahat dan minum obat',
                    'notes' => null,
                    'doctor_fee' => $doctorFee,
                    'additional_fee' => $additionalFee,
                    'total_cost' => 0
                ]);

                $medicineTotal = 0;

                $randomMedicines = $medicines->random(rand(1, 3));

                foreach ($randomMedicines as $medicine) {

                    if ($medicine->stock <= 0) {
                        continue;
                    }

                    $qty = rand(1, 3);
                    $unitPrice = $medicine->price;
                    $subtotal = $qty * $unitPrice;

                    VisitMedicine::create([
                        'visit_id' => $visit->id,
                        'medicine_id' => $medicine->id,
                        'quantity' => $qty,
                        'unit_price' => $unitPrice,
                        'subtotal' => $subtotal,
                        'dosage_instruction' => '3x sehari setelah makan'
                    ]);

                    $medicine->decrement('stock', $qty);

                    $medicineTotal += $subtotal;
                }

                $visit->update([
                    'total_cost' => $doctorFee + $additionalFee + $medicineTotal
                ]);

                DB::commit();

            } catch (\Exception $e) {
                DB::rollBack();
            }
        }
    }
}
