@extends('layouts.app')

@section('title', 'Add Record')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Add Ghassal Record</h1>

    <style>
        select {
            background-position: left 0.75rem center !important;
            padding-right: 2.5rem !important;
        }
    </style>

    <form method="POST" action="{{ route('ghassal.store') }}"
          class="bg-white rounded-lg shadow-lg p-8 max-w-xl">
        @csrf

        <div class="grid grid-cols-1 gap-4 mb-4">
            {{-- Country --}}
            <div>
                <label class="block mb-1 font-medium">ملک *</label>
                <select name="country" id="country" class="w-full border rounded px-3 py-2 text-right appearance-none bg-no-repeat" style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27 fill=%27none%27 viewBox=%270 0 20 20%27%3E%3Cpath stroke=%27%236b7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%271.5%27 d=%27m6 8 4 4 4-4%27%2F%3E%3C%2Fsvg%3E'); background-position: left 0.5rem center; background-size: 1.5em 1.5em;" required>
                    <option value="">سلیکٹ کریں</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" data-name="{{ $country->name ?? 'Pakistan' }}">{{ $country->name ?? 'Pakistan' }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="country_name" id="country_name">
                @error('country') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Province --}}
            <div>
                <label class="block mb-1 font-medium">صوبہ *</label>
                <select name="province" id="province" class="w-full border rounded px-3 py-2 text-right appearance-none bg-no-repeat" style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27 fill=%27none%27 viewBox=%270 0 20 20%27%3E%3Cpath stroke=%27%236b7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%271.5%27 d=%27m6 8 4 4 4-4%27%2F%3E%3C%2Fsvg%3E'); background-position: left 0.5rem center; background-size: 1.5em 1.5em;" required disabled>
                    <option value="">پہلے ملک منتخب کریں</option>
                </select>
                <input type="hidden" name="province_name" id="province_name">
                @error('province') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Division --}}
            <div>
                <label class="block mb-1 font-medium">ڈویژن *</label>
                <select name="division" id="division" class="w-full border rounded px-3 py-2 text-right appearance-none bg-no-repeat" style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27 fill=%27none%27 viewBox=%270 0 20 20%27%3E%3Cpath stroke=%27%236b7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%271.5%27 d=%27m6 8 4 4 4-4%27%2F%3E%3C%2Fsvg%3E'); background-position: left 0.5rem center; background-size: 1.5em 1.5em;" required disabled>
                    <option value="">پہلے صوبہ منتخب کریں</option>
                </select>
                <input type="hidden" name="division_name" id="division_name">
                @error('division') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- District --}}
            <div>
                <label class="block mb-1 font-medium">ڈسٹرکٹ/میٹروپولیٹن *</label>
                <select name="district" id="district" class="w-full border rounded px-3 py-2 text-right appearance-none bg-no-repeat" style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27 fill=%27none%27 viewBox=%270 0 20 20%27%3E%3Cpath stroke=%27%236b7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%271.5%27 d=%27m6 8 4 4 4-4%27%2F%3E%3C%2Fsvg%3E'); background-position: left 0.5rem center; background-size: 1.5em 1.5em;" required disabled>
                    <option value="">پہلے ڈویژن منتخب کریں</option>
                </select>
                <input type="hidden" name="district_name" id="district_name">
                @error('district') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Tehsil --}}
            <div>
                <label class="block mb-1 font-medium">تحصیل/ٹاؤن/زون *</label>
                <select name="tehsil" id="tehsil" class="w-full border rounded px-3 py-2 text-right appearance-none bg-no-repeat" style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27 fill=%27none%27 viewBox=%270 0 20 20%27%3E%3Cpath stroke=%27%236b7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%271.5%27 d=%27m6 8 4 4 4-4%27%2F%3E%3C%2Fsvg%3E'); background-position: left 0.5rem center; background-size: 1.5em 1.5em;" required disabled>
                    <option value="">پہلے ڈسٹرکٹ منتخب کریں</option>
                </select>
                <input type="hidden" name="tehsil_name" id="tehsil_name">
                @error('tehsil') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Sub Tehsil --}}
            <div>
                <label class="block mb-1 font-medium">سب تحصیل/ایریا *</label>
                <select name="sub_tehsil" id="sub_tehsil" class="w-full border rounded px-3 py-2 text-right appearance-none bg-no-repeat" style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27 fill=%27none%27 viewBox=%270 0 20 20%27%3E%3Cpath stroke=%27%236b7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%271.5%27 d=%27m6 8 4 4 4-4%27%2F%3E%3C%2Fsvg%3E'); background-position: left 0.5rem center; background-size: 1.5em 1.5em;" required disabled>
                    <option value="">پہلے تحصیل منتخب کریں</option>
                </select>
                <input type="hidden" name="sub_tehsil_name" id="sub_tehsil_name">
                @error('sub_tehsil') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- UC --}}
            <div>
                <label class="block mb-1 font-medium">یوسی/سیکٹر *</label>
                <select name="uc" id="uc" class="w-full border rounded px-3 py-2 text-right appearance-none bg-no-repeat" style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27 fill=%27none%27 viewBox=%270 0 20 20%27%3E%3Cpath stroke=%27%236b7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%271.5%27 d=%27m6 8 4 4 4-4%27%2F%3E%3C%2Fsvg%3E'); background-position: left 0.5rem center; background-size: 1.5em 1.5em;" required disabled>
                    <option value="">پہلے سب تحصیل منتخب کریں</option>
                </select>
                <input type="hidden" name="uc_name" id="uc_name">
                @error('uc') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Address --}}
            <div>
                <label class="block mb-1 font-medium">مقام (Address) *</label>
                <input type="text" name="address" value="{{ old('address') }}" class="w-full border rounded px-3 py-2 text-right" required>
                @error('address') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <hr class="my-6">

        <div class="grid grid-cols-1 gap-4">
            <div>
                <label class="block mb-1 font-medium">نام غسال *</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2 text-right" required>
                @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block mb-1 font-medium">غسال کا رابطہ نمبر *</label>
                <input type="text" name="contact" value="{{ old('contact') }}" class="w-full border rounded px-3 py-2 text-right" required>
                @error('contact') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block mb-1 font-medium">غسل کا وقت *</label>
                <input type="text" name="time_of_ghusal" value="{{ old('time_of_ghusal') }}" placeholder="e.g. 10:00 AM" class="w-full border rounded px-3 py-2 text-right" required>
                @error('time_of_ghusal') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-8 flex items-center gap-3">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded shadow transition-colors">
                Save Record
            </button>
            <a href="{{ route('ghassal.index') }}" class="text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selects = {
                country: document.getElementById('country'),
                province: document.getElementById('province'),
                division: document.getElementById('division'),
                district: document.getElementById('district'),
                tehsil: document.getElementById('tehsil'),
                sub_tehsil: document.getElementById('sub_tehsil'),
                uc: document.getElementById('uc')
            };

            function updateHiddenName(id) {
                const select = selects[id];
                const hidden = document.getElementById(id + '_name');
                if (select.selectedIndex > 0) {
                    hidden.value = select.options[select.selectedIndex].text;
                } else {
                    hidden.value = '';
                }
            }

            function clearDownstream(startId) {
                const keys = Object.keys(selects);
                let started = false;
                for (const key of keys) {
                    if (key === startId) {
                        started = true;
                        continue;
                    }
                    if (started) {
                        selects[key].innerHTML = '<option value="">سلیکٹ کریں</option>';
                        selects[key].disabled = true;
                        document.getElementById(key + '_name').value = '';
                    }
                }
            }

            async function fetchData(url, targetSelect, placeholder) {
                targetSelect.innerHTML = '<option value="">لوڈنگ...</option>';
                try {
                    const response = await fetch(url);
                    const data = await response.json();
                    targetSelect.innerHTML = `<option value="">${placeholder}</option>`;
                    if (data.length > 0) {
                        data.forEach(item => {
                            targetSelect.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                        });
                        targetSelect.disabled = false;
                    } else {
                        targetSelect.innerHTML = '<option value="">کوئی ڈیٹا نہیں ملا</option>';
                        targetSelect.disabled = true;
                    }
                } catch (error) {
                    console.error('Error fetching data:', error);
                    targetSelect.innerHTML = '<option value="">سرور ایرر</option>';
                }
            }

            selects.country.addEventListener('change', function() {
                updateHiddenName('country');
                clearDownstream('country');
                if (this.value) {
                    fetchData(`/get-provinces/${this.value}`, selects.province, 'صوبہ منتخب کریں');
                }
            });

            selects.province.addEventListener('change', function() {
                updateHiddenName('province');
                clearDownstream('province');
                if (this.value) {
                    fetchData(`/get-divisions/${this.value}`, selects.division, 'ڈویژن منتخب کریں');
                }
            });

            selects.division.addEventListener('change', function() {
                updateHiddenName('division');
                clearDownstream('division');
                if (this.value) {
                    fetchData(`/get-districts/${this.value}`, selects.district, 'ڈسٹرکٹ منتخب کریں');
                }
            });

            selects.district.addEventListener('change', function() {
                updateHiddenName('district');
                clearDownstream('district');
                if (this.value) {
                    fetchData(`/get-tehsils/${this.value}`, selects.tehsil, 'تحصیل منتخب کریں');
                }
            });

            selects.tehsil.addEventListener('change', function() {
                updateHiddenName('tehsil');
                clearDownstream('tehsil');
                if (this.value) {
                    fetchData(`/get-sub-tehsils/${this.value}`, selects.sub_tehsil, 'سب تحصیل منتخب کریں');
                }
            });

            selects.sub_tehsil.addEventListener('change', function() {
                updateHiddenName('sub_tehsil');
                clearDownstream('sub_tehsil');
                if (this.value) {
                    fetchData(`/get-ucs/${this.value}`, selects.uc, 'یوسی منتخب کریں');
                }
            });

            selects.uc.addEventListener('change', function() {
                updateHiddenName('uc');
            });
        });
    </script>
@endsection