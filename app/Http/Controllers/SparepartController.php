<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk upload gambar

class SparepartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super_admin,admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Sparepart::with(['category', 'supplier']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('code', 'LIKE', "%{$search}%")
                    ->orWhere('brand', 'LIKE', "%{$search}%")
                    ->orWhere('barcode', 'LIKE', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by brand type (baru)
        if ($request->filled('brand_type')) {
            $query->where('brand_type', $request->brand_type);
        }

        // Filter by stock status
        if ($request->filled('stock_status')) {
            switch ($request->stock_status) {
                case 'low':
                    $query->lowStock();
                    break;
                case 'out':
                    $query->where('stock', '<=', 0);
                    break;
                case 'active':
                    $query->where('is_active', true);
                    break;
            }
        }

        $spareparts = $query->orderBy('name')->paginate(15);
        $categories = Category::active()->get();

        return view('spareparts.index', compact('spareparts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::active()->get();
        $suppliers = Supplier::where('is_active', true)->get();

        // Generate kode sparepart otomatis yang UNIK
        $newCode = $this->generateUniqueCode();

        return view('spareparts.create', compact('categories', 'suppliers', 'newCode'));
    }

    /**
     * Generate unique sparepart code
     */
    private function generateUniqueCode()
    {
        $prefix = 'SPR';

        // Kombinasi: SPR + Tanggal (YYMMDD) + Random 3 digit
        $date = date('ymd'); // 240310
        $random = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $code = $prefix . $date . $random; // Contoh: SPR240310123

        // Cek jika masih ada yang sama (kemungkinan sangat kecil)
        $attempts = 0;
        while (Sparepart::where('code', $code)->exists() && $attempts < 10) {
            $random = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            $code = $prefix . $date . $random;
            $attempts++;
        }

        return $code;
    }

    /**
     * Generate unique code via AJAX
     */
    public function generateCode()
    {
        $newCode = $this->generateUniqueCode();

        return response()->json([
            'success' => true,
            'code' => $newCode
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|unique:spareparts',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'brand' => 'nullable|string|max:100',
            'brand_type' => 'required|in:viar,non-viar,optional', // Tambahkan validasi
            'unit' => 'required|string|max:20',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'max_stock' => 'nullable|integer|min:0',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'description' => 'nullable|string',
            'location_rack' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Tambahkan validasi image
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->name . '-' . $request->code);
        $data['barcode'] = $request->code;

        $data['supplier_id'] = $request->supplier_id ?? null;
        $data['max_stock'] = $request->max_stock ?? null;
        $data['discount'] = $request->discount ?? 0;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/spareparts', $imageName);
            $data['image'] = $imageName;
        }

        Sparepart::create($data);

        return redirect()->route('spareparts.index')
            ->with('success', 'Sparepart berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sparepart $sparepart)
    {
        $sparepart->load(['category', 'supplier']);
        return view('spareparts.show', compact('sparepart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sparepart $sparepart)
    {
        $categories = Category::active()->get();
        $suppliers = Supplier::where('is_active', true)->get();

        return view('spareparts.edit', compact('sparepart', 'categories', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sparepart $sparepart)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'brand' => 'nullable|string|max:100',
            'brand_type' => 'required|in:viar,non-viar,optional', // Tambahkan validasi
            'unit' => 'required|string|max:20',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'max_stock' => 'nullable|integer|min:0',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'description' => 'nullable|string',
            'location_rack' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Tambahkan validasi image
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except('image', '_token', '_method');
        $data['slug'] = Str::slug($request->name . '-' . $sparepart->code);
        $data['is_active'] = $request->has('is_active');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($sparepart->image) {
                Storage::delete('public/spareparts/' . $sparepart->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/spareparts', $imageName);
            $data['image'] = $imageName;
        }

        $sparepart->update($data);

        return redirect()->route('spareparts.index')
            ->with('success', 'Sparepart berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sparepart $sparepart)
    {
        // Cek apakah sparepart memiliki transaksi
        if ($sparepart->transactionDetails()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Sparepart tidak bisa dihapus karena sudah memiliki transaksi.');
        }

        // Delete image
        if ($sparepart->image) {
            Storage::delete('public/spareparts/' . $sparepart->image);
        }

        $sparepart->delete();

        return redirect()->route('spareparts.index')
            ->with('success', 'Sparepart berhasil dihapus.');
    }

    /**
     * Generate barcode untuk sparepart
     */
    public function generateBarcode(Sparepart $sparepart)
    {
        // Logic untuk generate barcode
        return view('spareparts.barcode', compact('sparepart'));
    }

    /**
     * Export sparepart ke Excel/PDF
     */
    public function export(Request $request)
    {
        // Logic export
    }
}
