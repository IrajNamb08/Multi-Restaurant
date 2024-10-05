<?php

namespace App\Models;

use App\Models\Commande;
use App\Models\PointdeVente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TableRestaurant extends Model
{
    use HasFactory;
    protected $fillable = ['numero_table','pointdevente_id','qr_code'];

    public function pointdevente()
    {
        return $this->belongsTo(PointdeVente::class);
    }

    public function generateQrCode()
    {
        $restaurant_id = $this->pointdevente->restaurant_id;
        $pointdevente_id = $this->pointdevente_id;
        $table_id = $this->id;
        $table = TableRestaurant::find($table_id);
        $table = $table->numero_table;
        // Générer une URL simple que l'application mobile pourra interpréter
        $url = "'restaurant_id':'{$restaurant_id}','pointdevente_id':'{$pointdevente_id}','table_id':'{$table_id}'";

        $qrCode = QrCode::size(300)->generate($url);
        $qrCodePath = 'qrcodes/table_' . $this->id . '.svg';
        
        Storage::disk('public')->put($qrCodePath, $qrCode);

        $this->update(['qr_code' => $qrCodePath]);
    }
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
