<div class="space-y-5">

    <div class="grid md:grid-cols-2 gap-5">

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                NIS
            </label>

            <input type="text" name="nis" value="{{ old('nis', $siswa->nis ?? '') }}"
                class="w-full rounded-2xl border-slate-200 bg-slate-50" placeholder="Masukkan NIS">

            <x-input-error :messages="$errors->get('nis')" class="mt-2" />
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Nama Siswa
            </label>

            <input type="text" name="nama_siswa" value="{{ old('nama_siswa', $siswa->nama_siswa ?? '') }}"
                class="w-full rounded-2xl border-slate-200 bg-slate-50" placeholder="Nama lengkap siswa">

            <x-input-error :messages="$errors->get('nama_siswa')" class="mt-2" />
        </div>

    </div>

    <div class="grid md:grid-cols-3 gap-5">

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Jenis Kelamin
            </label>

            <select name="jenis_kelamin" class="w-full rounded-2xl border-slate-200 bg-slate-50">

                <option value="">Pilih</option>

                <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>
                    Laki-Laki
                </option>

                <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>
                    Perempuan
                </option>

            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Tanggal Lahir
            </label>

            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir ?? '') }}"
                class="w-full rounded-2xl border-slate-200 bg-slate-50">
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Status
            </label>

            <select name="status_aktif" class="w-full rounded-2xl border-slate-200 bg-slate-50">

                <option value="1" {{ old('status_aktif', $siswa->status_aktif ?? 1) == 1 ? 'selected' : '' }}>
                    Aktif
                </option>

                <option value="0" {{ old('status_aktif', $siswa->status_aktif ?? 1) == 0 ? 'selected' : '' }}>
                    Tidak Aktif
                </option>

            </select>
        </div>

    </div>

    <div class="grid md:grid-cols-2 gap-5">

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Kategori
            </label>

            <select name="kategori_id" class="w-full rounded-2xl border-slate-200 bg-slate-50">

                <option value="">Pilih Kategori</option>

                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}"
                        {{ old('kategori_id', $siswa->kategori_id ?? '') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach

            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Kelas
            </label>

            <select name="kelas_id" class="w-full rounded-2xl border-slate-200 bg-slate-50">

                <option value="">Pilih Kelas</option>

                @foreach ($kelas as $kls)
                    <option value="{{ $kls->id }}"
                        {{ old('kelas_id', $siswa->kelas_id ?? '') == $kls->id ? 'selected' : '' }}>
                        {{ $kls->nama_kelas }}
                    </option>
                @endforeach

            </select>
        </div>

    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">
            Alamat
        </label>

        <textarea name="alamat" rows="3" class="w-full rounded-2xl border-slate-200 bg-slate-50">{{ old('alamat', $siswa->alamat ?? '') }}</textarea>
    </div>

    <div class="grid md:grid-cols-2 gap-5">

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                No HP
            </label>

            <input type="text" name="no_hp" value="{{ old('no_hp', $siswa->no_hp ?? '') }}"
                class="w-full rounded-2xl border-slate-200 bg-slate-50">
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Nama Wali
            </label>

            <input type="text" name="nama_wali" value="{{ old('nama_wali', $siswa->nama_wali ?? '') }}"
                class="w-full rounded-2xl border-slate-200 bg-slate-50">
        </div>

    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">
            No HP Wali
        </label>

        <input type="text" name="no_hp_wali" value="{{ old('no_hp_wali', $siswa->no_hp_wali ?? '') }}"
            class="w-full rounded-2xl border-slate-200 bg-slate-50">
    </div>

</div>
