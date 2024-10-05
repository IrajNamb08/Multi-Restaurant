<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\PointdeVente;
use Illuminate\Http\Request;
use App\Models\TableRestaurant;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TableRestaurantRequest;

class TableRestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pointdevente = auth()->user()->pointdevente_id;
        $tables = TableRestaurant::where('pointdevente_id',$pointdevente)->get();
        $pointdevente = PointdeVente::findOrFail($pointdevente);
        $restaurant_id = $pointdevente->restaurant_id;
        $restaurant = Restaurant::findOrFail($restaurant_id);

        return view('table_restaurant.liste',compact('tables','pointdevente','restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('table_restaurant.ajout');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TableRestaurantRequest $request)
    {
        $data = $request->validated();
        $data['pointdevente_id'] = auth()->user()->pointdevente_id;
        $table = TableRestaurant::create($data);
        $table->generateQrCode();
        return redirect()->route('table.index')->with('success','Table ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TableRestaurant $id)
    {
        if ($id->qr_code) {
            $qrCodePath = str_replace('storage/qrcodes', '', $id->qr_code);
            if (Storage::disk('public')->exists($qrCodePath)) {
                Storage::disk('public')->delete($qrCodePath);
            }
        }
        $id->delete();
        return redirect()->route('table.index')->with('success','Table supprimé avec succès');
    }

    public function printQrCodes()
    {
        $pointdevente = auth()->user()->pointdevente_id;
        $tables = TableRestaurant::where('pointdevente_id',$pointdevente)->get();
        $pointdevente = PointdeVente::findOrFail($pointdevente);
        $restaurant_id = $pointdevente->restaurant_id;
        $restaurant = Restaurant::findOrFail($restaurant_id);
        $pdf = Pdf::loadView('table_restaurant.print_pdf', compact('tables', 'pointdevente','restaurant'));
        return $pdf->download('qr_codes_tables.pdf');
    }
}
