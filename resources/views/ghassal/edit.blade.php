@extends('layouts.app')

@section('title', 'Edit Record')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Edit Ghassal Record</h1>

    <style>
        select {
            background-position: left 0.75rem center !important;
            padding-right: 2.5rem !important;
        }
    </style>

    <form method="POST" action="{{ route('ghassal.update', $ghassal) }}"
          class="bg-white rounded-lg shadow-lg p-8 max-w-xl">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-4 mb-4">
            {{-- Country --}}
            <div>
                <label class="block mb-1 font-medium">ملک *</label>
                <select name="country" id="country" class="w-full border rounded px-3 py-2 text-right appearance-none bg-no-repeat" style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27 fill=%27none%27 viewBox=%270 0 20 20%27%3E%3Cpath stroke=%27%236b7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%271.5%27 d=%27m6 8 4 4 4-4%27%2F%3E%3C%2Fsvg%3E'); background-position: left 0.5rem center; background-size: 1.5em 1.5em;" required>
                    <option value="">سلیکٹ کریں</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ $ghassal->country_id == $country->id ? 'selected' : '' }}>
                            {{ $country->name ?? 'Pakistan' }}
                        </option>
                    @endforeach
                </select>
                <input type="hidden" name="country_name" id="country_name" value="{{ $ghassal->country }}">
                @error('country') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Province --}}
            <div>
                <label class="block mb-1 font-medium">صوبہ *</label>
                <select name="province" id="province" class="w-full border rounded px-3 py-2 text-right appearance-none bg-no-repeat" style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27 fill=%27none%27 viewBox=%270 0 20 20%27%3E%3Cpath stroke=%27%236b7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%271.5%27 d=%27m6 8 4 4 4-4%27%2F%3E%3C%2Fsvg%3E'); background-position: left 0.5rem center; background-size: 1.5em 1.5em;" required>
                    @if($ghassal->province)
                        <option value="{{ $ghassal->province_id }}" selected>{{ $ghassal->province }}</option>
                    @else
                        <option value="">پہلے ملک منتخب کریں</option>
                    @endif
                </select>
                <input type="hidden" name="province_name" id="province_name" value="{{ $ghassal->province }}">
                @error('province') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Division --}}
            <div>
                <label class="block mb-1 font-medium">ڈویژن *</label>
                <select name="division" id="division" class="w-full border rounded px-3 py-2 text-right appearance-none bg-no-repeat" style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27 fill=%27none%27 viewBox=%270 0 20 20%27%3E%3Cpath stroke=%27%236b7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%271.5%27 d=%27m6 8 4 4 4-4%27%2F%3E%3C%2Fsvg%3E'); background-position: left 0.5rem center; background-size: 1.5em 1.5em;" required>
                    @if($ghassal->division)
                        <option value="{{ $ghassal->division_id }}" selected>{{ $ghassal->division }}</option>
                    @else
                        <option value="">پہلے صوبہ منتخب کریں</option>
                    @endif
                </select>
                <input type="hidden" name="division_name" id="division_name" value="{{ $ghassal->division }}">
                @error('division') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- District --}}
            <div>
                <label class="block mb-1 font-medium">ڈسٹرکٹ/میٹروپولیٹن *</label>
                <select name="district" id="district" class="w-full border rounded px-3 py-2 text-right appearance-none bg-no-repeat" style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27 fill=%27none%27 viewBox=%270 0 20 20%27%3E%3Cpath stroke=%27%236b7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%271.5%27 d=%27m6 8 4 4 4-4%27%2F%3E%3C%2Fsvg%3E'); background-position: left 0.5rem center; background-size: 1.5em 1.5em;" required>
                    @if($ghassal->district)
                        <option value="{{ $ghassal->district_id }}" selected>{{ $ghassal->district }}</option>
                    @else
                        <option value="">پہلے ڈویژن منتخب کریں</option>
                    @endif
                </select>
                <input type="hidden" name="district_name" id="district_name" value="{{ $ghassal->district }}">
                @error('district') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Tehsil --}}
            <div>
                <label class="block mb-1 font-medium">تحصیل/ٹاؤن/زون *</label>
                <select name="tehsil" id="tehsil" class="w-full border rounded px-3 py-2 text-right appearance-none bg-no-repeat" style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27 fill=%27none%27 viewBox=%270 0 20 20%27%3E%3Cpath stroke=%27%236b7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%271.5%27 d=%27m6 8 4 4 4-4%27%2F%3E%3C%2Fsvg%3E'); background-position: left 0.5rem center; background-size: 1.5em 1.5em;" required>
                    @if($ghassal->tehsil)
                        <option value="{{ $ghassal->tehsil_id }}" selected>{{ $ghassal->tehsil }}</option>
                    @else
                        <option value="">پہلے ڈسٹرکٹ منتخب کریں</option>
                    @endif
                </select>
                <input type="hidden" name="tehsil_name" id="tehsil_name" value="{{ $ghassal->tehsil }}">
                @error('tehsil') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Sub Tehsil --}}
            <div>
                <label class="block mb-1 font-medium">سب تحصیل/ایریا *</label>
                <select name="sub_tehsil" id="sub_tehsil" class="w-full border rounded px-3 py-2 text-right appearance-none bg-no-repeat" style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27 fill=%27none%27 viewBox=%270 0 20 20%27%3E%3Cpath stroke=%27%236b7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%271.5%27 d=%27m6 8 4 4 4-4%27%2F%3E%3C%2Fsvg%3E'); background-position: left 0.5rem center; background-size: 1.5em 1.5em;" required>
                    @if($ghassal->sub_tehsil)
                        <option value="{{ $ghassal->sub_tehsil_id }}" selected>{{ $ghassal->sub_tehsil }}</option>
                    @else
                        <option value="">پہلے تحصیل منتخب کریں</option>
                    @endif
                </select>
                <input type="hidden" name="sub_tehsil_name" id="sub_tehsil_name" value="{{ $ghassal->sub_tehsil }}">
                @error('sub_tehsil') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- UC --}}
            <div>
                <label class="block mb-1 font-medium">یوسی/سیکٹر *</label>
                <select name="uc" id="uc" class="w-full border rounded px-3 py-2 text-right appearance-none bg-no-repeat" style="background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27 fill=%27none%27 viewBox=%270 0 20 20%27%3E%3Cpath stroke=%27%236b7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%271.5%27 d=%27m6 8 4 4 4-4%27%2F%3E%3C%2Fsvg%3E'); background-position: left 0.5rem center; background-size: 1.5em 1.5em;" required>
                    @if($ghassal->uc)
                        <option value="{{ $ghassal->uc_id }}" selected>{{ $ghassal->uc }}</option>
                    @else
                        <option value="">پہلے سب تحصیل منتخب کریں</option>
                    @endif
                </select>
                <input type="hidden" name="uc_name" id="uc_name" value="{{ $ghassal->uc }}">
                @error('uc') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Address --}}
            <div>
                <label class="block mb-1 font-medium">مقام (Address) *</label>
                <input type="text" name="address" value="{{ old('address', $ghassal->address) }}" class="w-full border rounded px-3 py-2 text-right" required>
                @error('address') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <hr class="my-6">

        <div class="grid grid-cols-1 gap-4">
            <div>
                <label class="block mb-1 font-medium">نام غسال *</label>
                <input type="text" name="name" value="{{ old('name', $ghassal->name) }}" class="w-full border rounded px-3 py-2 text-right" required>
                @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block mb-1 font-medium">غسال کا رابطہ نمبر *</label>
                <input type="text" name="contact" value="{{ old('contact', $ghassal->contact) }}" class="w-full border rounded px-3 py-2 text-right" required>
                @error('contact') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block mb-1 font-medium">غسل کا وقت *</label>
                <input type="text" name="time_of_ghusal" value="{{ old('time_of_ghusal', $ghassal->time_of_ghusal) }}" class="w-full border rounded px-3 py-2 text-right" required>
                @error('time_of_ghusal') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-8 flex items-center gap-3">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded shadow transition-colors">
                Update Record
            </button>
            <a href="{{ route('ghassal.index') }}" class="text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('select').select2({
                dir: 'rtl',
                width: '100%'
            });

            const selects = {
                country: $('#country'),
                province: $('#province'),
                division: $('#division'),
                district: $('#district'),
                tehsil: $('#tehsil'),
                sub_tehsil: $('#sub_tehsil'),
                uc: $('#uc')
            };

            const initialIds = {
                province: "{{ $ghassal->province_id }}",
                division: "{{ $ghassal->division_id }}",
                district: "{{ $ghassal->district_id }}",
                tehsil: "{{ $ghassal->tehsil_id }}",
                sub_tehsil: "{{ $ghassal->sub_tehsil_id }}",
                uc: "{{ $ghassal->uc_id }}"
            };

            function updateHiddenName(id) {
                const select = selects[id];
                const hidden = $('#' + id + '_name');
                const selectedText = select.find('option:selected').text();
                if (select.val() !== '') {
                    hidden.val(selectedText);
                } else {
                    hidden.val('');
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
                        selects[key].empty().append('<option value="">سلیکٹ کریں</option>');
                        selects[key].prop('disabled', true);
                        $('#' + key + '_name').val('');
                        selects[key].trigger('change.select2');
                    }
                }
            }

            async function fetchData(url, targetSelect, placeholder, selectedId = null) {
                targetSelect.empty().append('<option value="">لوڈنگ...</option>').trigger('change.select2');
                try {
                    const response = await fetch(url);
                    const data = await response.json();
                    targetSelect.empty().append(`<option value="">${placeholder}</option>`);
                    if (data.length > 0) {
                        data.forEach(item => {
                            const selected = selectedId == item.id ? 'selected' : '';
                            targetSelect.append(`<option value="${item.id}" ${selected}>${item.name}</option>`);
                        });
                        targetSelect.prop('disabled', false);
                        targetSelect.trigger('change.select2');
                        return true;
                    } else {
                        targetSelect.empty().append('<option value="">کوئی ڈیٹا نہیں ملا</option>');
                        targetSelect.prop('disabled', true);
                        targetSelect.trigger('change.select2');
                        return false;
                    }
                } catch (error) {
                    console.error('Error fetching data:', error);
                    targetSelect.empty().append('<option value="">سرور ایرر</option>').trigger('change.select2');
                    return false;
                }
            }

            async function init() {
                if (selects.country.val()) {
                    const hasProvinces = await fetchData(`/get-provinces/${selects.country.val()}`, selects.province, 'صوبہ منتخب کریں', initialIds.province);
                    if (hasProvinces && initialIds.province) {
                        const hasDivisions = await fetchData(`/get-divisions/${initialIds.province}`, selects.division, 'ڈویژن منتخب کریں', initialIds.division);
                        if (hasDivisions && initialIds.division) {
                            const hasDistricts = await fetchData(`/get-districts/${initialIds.division}`, selects.district, 'ڈسٹرکٹ منتخب کریں', initialIds.district);
                            if (hasDistricts && initialIds.district) {
                                const hasTehsils = await fetchData(`/get-tehsils/${initialIds.district}`, selects.tehsil, 'تحصیل منتخب کریں', initialIds.tehsil);
                                if (hasTehsils && initialIds.tehsil) {
                                    const hasSubTehsils = await fetchData(`/get-sub-tehsils/${initialIds.tehsil}`, selects.sub_tehsil, 'سب تحصیل منتخب کریں', initialIds.sub_tehsil);
                                    if (hasSubTehsils && initialIds.sub_tehsil) {
                                        await fetchData(`/get-ucs/${initialIds.sub_tehsil}`, selects.uc, 'یوسی منتخب کریں', initialIds.uc);
                                    }
                                }
                            }
                        }
                    }
                }
            }

            init();

            selects.country.on('change', function() {
                updateHiddenName('country');
                clearDownstream('country');
                if ($(this).val()) {
                    fetchData(`/get-provinces/${$(this).val()}`, selects.province, 'صوبہ منتخب کریں');
                }
            });

            selects.province.on('change', function() {
                updateHiddenName('province');
                clearDownstream('province');
                if ($(this).val()) {
                    fetchData(`/get-divisions/${$(this).val()}`, selects.division, 'ڈویژن منتخب کریں');
                }
            });

            selects.division.on('change', function() {
                updateHiddenName('division');
                clearDownstream('division');
                if ($(this).val()) {
                    fetchData(`/get-districts/${$(this).val()}`, selects.district, 'ڈسٹرکٹ منتخب کریں');
                }
            });

            selects.district.on('change', function() {
                updateHiddenName('district');
                clearDownstream('district');
                if ($(this).val()) {
                    fetchData(`/get-tehsils/${$(this).val()}`, selects.tehsil, 'تحصیل منتخب کریں');
                }
            });

            selects.tehsil.on('change', function() {
                updateHiddenName('tehsil');
                clearDownstream('tehsil');
                if ($(this).val()) {
                    fetchData(`/get-sub-tehsils/${$(this).val()}`, selects.sub_tehsil, 'سب تحصیل منتخب کریں');
                }
            });

            selects.sub_tehsil.on('change', function() {
                updateHiddenName('sub_tehsil');
                clearDownstream('sub_tehsil');
                if ($(this).val()) {
                    fetchData(`/get-ucs/${$(this).val()}`, selects.uc, 'یوسی منتخب کریں');
                }
            });

            selects.uc.on('change', function() {
                updateHiddenName('uc');
            });
        });
    </script>
@endsection