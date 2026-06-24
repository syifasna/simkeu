<div class="space-y-5">

    <div>
        <label for="nama_kelas" class="block text-sm font-semibold text-slate-700 mb-2">
            Nama Kelas
        </label>

        <input type="text" name="nama_kelas" id="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas ?? '') }}"
            placeholder="Contoh: VII A"
            class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]"
            required>

        <x-input-error :messages="$errors->get('nama_kelas')" class="mt-2" />
    </div>

    <div>
        <label for="tingkat" class="block text-sm font-semibold text-slate-700 mb-2">
            Tingkat
        </label>

        <select name="tingkat" id="tingkat"
            class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]"
            required>
            <option value="">-- Pilih Tingkat --</option>
            <option value="VII" {{ old('tingkat', $kelas->tingkat ?? '') == 'VII' ? 'selected' : '' }}>VII</option>
            <option value="VIII" {{ old('tingkat', $kelas->tingkat ?? '') == 'VIII' ? 'selected' : '' }}>VIII</option>
            <option value="IX" {{ old('tingkat', $kelas->tingkat ?? '') == 'IX' ? 'selected' : '' }}>IX</option>
        </select>

        <x-input-error :messages="$errors->get('tingkat')" class="mt-2" />
    </div>

    <div>
        <label for="wali_kelas" class="block text-sm font-semibold text-slate-700 mb-2">
            Wali Kelas
        </label>

        <input type="text" name="wali_kelas" id="wali_kelas"
            value="{{ old('wali_kelas', $kelas->wali_kelas ?? '') }}" placeholder="Contoh: Ust. Ahmad Fauzi, S.Pd"
            class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]">

        <x-input-error :messages="$errors->get('wali_kelas')" class="mt-2" />
    </div>

    <div>
        <label for="kapasitas" class="block text-sm font-semibold text-slate-700 mb-2">
            Kapasitas Siswa
        </label>

        <input type="number" name="kapasitas" id="kapasitas" value="{{ old('kapasitas', $kelas->kapasitas ?? '') }}"
            placeholder="Contoh: 30" min="1"
            class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]"
            required>

        <x-input-error :messages="$errors->get('kapasitas')" class="mt-2" />
    </div>

</div>
