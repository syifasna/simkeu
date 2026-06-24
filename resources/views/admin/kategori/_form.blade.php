<div class="space-y-5">

    <div>
        <label for="nama_kategori" class="block text-sm font-semibold text-slate-700 mb-2">
            Nama Kategori
        </label>

        <input type="text" name="nama_kategori" id="nama_kategori"
            value="{{ old('nama_kategori', $kategori->nama_kategori ?? '') }}"
            placeholder="Contoh: Reguler, Anak Guru, Yatim"
            class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]"
            required>

        <x-input-error :messages="$errors->get('nama_kategori')" class="mt-2" />
    </div>

    <div>
        <label for="biaya_dasar" class="block text-sm font-semibold text-slate-700 mb-2">
            Biaya Dasar
        </label>

        <input type="number" name="biaya_dasar" id="biaya_dasar"
            value="{{ old('biaya_dasar', $kategori->biaya_dasar ?? '') }}" placeholder="Contoh: 500000"
            class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]"
            required>

        <x-input-error :messages="$errors->get('biaya_dasar')" class="mt-2" />
    </div>

    <div>
        <label for="persentase_potongan" class="block text-sm font-semibold text-slate-700 mb-2">
            Persentase Potongan
        </label>

        <input type="number" name="persentase_potongan" id="persentase_potongan"
            value="{{ old('persentase_potongan', $kategori->persentase_potongan ?? 0) }}" placeholder="Contoh: 10"
            min="0" max="100"
            class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]">

        <p class="text-xs text-slate-500 mt-1">
            Isi 0 jika tidak ada potongan.
        </p>

        <x-input-error :messages="$errors->get('persentase_potongan')" class="mt-2" />
    </div>

</div>
