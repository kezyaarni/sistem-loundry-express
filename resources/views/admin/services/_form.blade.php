<div class="mb-3">
    <label class="form-label">Nama Layanan</label>
    <input type="text" name="service_name" class="form-control"
        value="{{ old('service_name', $service->service_name ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Kategori</label>
    <select name="category" class="form-select">
        @foreach (['Kiloan', 'Satuan', 'Express'] as $category)
            <option value="{{ $category }}" @selected(old('category', $service->category ?? '') === $category)>
                {{ $category }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Tarif per Satuan (Rp)</label>
    <input type="number" name="price_per_unit" class="form-control" min="0"
        value="{{ old('price_per_unit', $service->price_per_unit ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Tipe Satuan</label>
    <select name="unit_type" class="form-select">
        @foreach (['Kg', 'Pcs'] as $unit)
            <option value="{{ $unit }}" @selected(old('unit_type', $service->unit_type ?? '') === $unit)>
                {{ $unit }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" class="form-control">{{ old('description', $service->description ?? '') }}</textarea>
</div>
