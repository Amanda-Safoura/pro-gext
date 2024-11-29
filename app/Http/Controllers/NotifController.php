<?php

namespace App\Http\Controllers;

use App\Models\CustomNotif;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class NotifController extends Controller
{
    public function showNotifs()
    {
        // Charger tous les notifications sans pagination
        $notifs = CustomNotif::where('user_id', auth()->id())->latest()->get();
        return view('site.pages.notifs', compact('notifs'));
    }


    public function getNotifsData()
    {
        $query = CustomNotif::where('user_id', auth()->id())->latest();

        return DataTables::of($query)
            ->addIndexColumn() // Ajoute un index pour la colonne #
            ->addColumn('checkbox', function ($row) {
                return ''; // Placeholder pour la colonne checkbox
            })
            ->addColumn('actions', function ($row) {
                return ''; // Placeholder pour les boutons d'action
            })
            ->editColumn('read', function ($row) {
                return $row->read ? true : false; // Convertit en booléen
            })
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->format('d F Y'); // Format : 18 Novembre 2024
            })
            ->editColumn('content', function ($row) {
                return $row->content; // Contenu HTML brut
            })
            ->rawColumns(['checkbox', 'actions', 'content']) // Inclure "content" ici pour afficher le HTML
            ->make(true);
    }

    public function bulkUpdate(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:custom_notifs,id',
            'read' => 'required|in:true,false',
        ]);

        CustomNotif::whereIn('id', $validated['ids'])->update(['read' => $validated['read'] === 'true']);
        return response()->json(['message' => 'Le statut des notifications a été mis à jour avec succès.']);
    }
}
