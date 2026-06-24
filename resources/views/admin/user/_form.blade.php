<div class="space-y-5">

    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}"
                class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]"
                placeholder="Nama user">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]"
                placeholder="email@gmail.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
    </div>

    <div>
        <label class="block text-sm font-semibold text-slate-700 mb-2">Role</label>
        <select name="role"
            class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]">
            <option value="">-- Pilih Role --</option>
            <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="staff" {{ old('role', $user->role ?? '') == 'staff' ? 'selected' : '' }}>Staff Keuangan
            </option>
            <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>User / Siswa
            </option>
        </select>
        <x-input-error :messages="$errors->get('role')" class="mt-2" />
    </div>

    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Password {{ isset($user) ? '(kosongkan jika tidak diganti)' : '' }}
            </label>
            <input type="password" name="password"
                class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]"
                placeholder="Password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]"
                placeholder="Ulangi password">
        </div>
    </div>

</div>
