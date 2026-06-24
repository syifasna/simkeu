<div class="space-y-5">

    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Nama Staff
            </label>

            <input type="text" name="name" value="{{ old('name', $staff->name ?? '') }}"
                placeholder="Masukkan nama staff"
                class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]">

            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Email
            </label>

            <input type="email" name="email" value="{{ old('email', $staff->email ?? '') }}"
                placeholder="staff@assulthon.com"
                class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]">

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Password {{ isset($staff) ? '(kosongkan jika tidak diganti)' : '' }}
            </label>

            <input type="password" name="password" placeholder="Masukkan password"
                class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]">

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                Konfirmasi Password
            </label>

            <input type="password" name="password_confirmation" placeholder="Ulangi password"
                class="w-full rounded-2xl border-slate-200 bg-slate-50 px-5 py-3 focus:border-[#D4AF37] focus:ring-[#D4AF37]">
        </div>
    </div>

    <div class="rounded-2xl bg-[#F8F6F0] border border-[#F5E7B2] p-4">
        <p class="text-sm text-slate-600">
            Role akun ini otomatis menjadi <b>Staff Keuangan</b>.
        </p>
    </div>

</div>
