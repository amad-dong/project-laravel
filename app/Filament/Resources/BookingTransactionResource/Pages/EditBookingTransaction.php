<?php

namespace App\Filament\Resources\BookingTransactionResource\Pages;

use App\Filament\Resources\BookingTransactionResource;
use App\Models\WorkshopParticipant;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;

class EditBookingTransaction extends EditRecord
{
    protected static string $resource = BookingTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Ambil peserta yang sudah ada dan tambahkan ke data formulir
        $data['participants'] = $this->record->participants->map(function (WorkshopParticipant $participant) {
            return [
                'name' => $participant->name,
                'occupation' => $participant->occupation,
                'email' => $participant->email,
            ];
        })->toArray();

        return $data;
    }
    protected function afterSave(): void
{
    DB::transaction(function () {
        $record = $this->record;
        $record->participants()->delete(); // Hapus peserta yang sudah ada untuk menghindari duplikasi
        $participants = $this->form->getState()['participants'];

        // Iterasi setiap peserta dan buat record baru di tabel workshop_participants
        foreach ($participants as $participant) {
            WorkshopParticipant::create([
                'workshop_id' => $record->workshop_id,
                'booking_transaction_id' => $record->id,
                'name' => $participant['name'],
                'occupation' => $participant['occupation'],
                'email' => $participant['email'],
            ]);
        }
    });
}
}