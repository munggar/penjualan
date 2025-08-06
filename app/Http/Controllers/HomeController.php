<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cost;
use Carbon\Carbon;
use illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        $query = Cost::query();

        $search = $request->search;
        $date = $request->date;

        // Pencarian berdasarkan teks (nama / deskripsi)
        if (!empty($search)) {
            $search = strtolower($search);

            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])->orWhereRaw('LOWER(description) LIKE ?', ["%{$search}%"]);

                // Jika isinya mirip tanggal, juga bisa cek ke kolom date
                if (strtotime($search)) {
                    $parsedDate = Carbon::parse($search)->format('Y-m-d');
                    $q->orWhereDate('date', $parsedDate); // pastikan kolom ini memang `date`
                }
            });
        }

        // Pencarian berdasarkan tanggal eksplisit dari input form
        if (!empty($date)) {
            try {
                $parsedDate = Carbon::parse($date)->format('Y-m-d');
                $query->whereDate('date', $parsedDate);
            } catch (\Exception $e) {
                // optional: log error jika parsing gagal
            }
        }

        $biaya = $query->latest()->paginate(10);

        return view('cost.index', compact('biaya'));
    }

    public function create()
    {
        return view('cost.create');
    }

    public function store(Request $request)
    {
        Cost::create([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'amount' => $request->amount,
        ]);
        return redirect()->route('cost.index')->with('success', 'Cost created successfully.');
    }
    public function edit($id)
    {
        $biaya = Cost::findOrFail($id);
        return view('cost.edit', compact('biaya'));
    }
    public function update(Request $request, $id)
    {
        $cost = Cost::findOrFail($id);
        $cost->update([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'amount' => $request->amount,
        ]);
        return redirect()->route('cost.index')->with('success', 'Cost updated successfully.');
    }
    public function destroy($id)
    {
        $cost = Cost::findOrFail($id);
        $cost->delete();
        return redirect()->route('cost.index')->with('success', 'Cost deleted successfully.');
    }
}
