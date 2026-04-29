@extends('layouts.app')

@section('title', 'Add Record')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Add Ghassal Record</h1>

    <form method="POST" action="{{ route('ghassal.store') }}"
          class="bg-white rounded shadow p-6 max-w-xl">
        @csrf

        <div class="mb-4">
            <label class="block mb-1">ملک *</label>
            <input type="text" name="country"
                   value="{{ old('country') }}"
                   class="w-full border rounded px-3 py-2">
            @error('country')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">صوبہ *</label>
            <input type="text" name="province"
                   value="{{ old('province') }}"
                   class="w-full border rounded px-3 py-2">
            @error('province')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">ڈویژن *</label>
            <input type="text" name="division"
                   value="{{ old('division') }}"
                   class="w-full border rounded px-3 py-2">
            @error('division')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">ڈسٹرکٹ/میٹروپولیٹن *</label>
            <input type="text" name="district"
                   value="{{ old('district') }}"
                   class="w-full border rounded px-3 py-2">
            @error('district')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">تحصیل/ٹاؤن/زون *</label>
            <input type="text" name="tehsil"
                   value="{{ old('tehsil') }}"
                   class="w-full border rounded px-3 py-2">
            @error('district')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">سب تحصیل/سب ٹاؤن/ایریا *</label>
            <input type="text" name="sub_tehsil"
                   value="{{ old('sub_tehsil') }}"
                   class="w-full border rounded px-3 py-2">
            @error('sub_tehsil')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">یوسی/سیکٹر *</label>
            <input type="text" name="uc"
                   value="{{ old('uc') }}"
                   class="w-full border rounded px-3 py-2">
            @error('uc')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">مقام *</label>
            <input type="text" name="address"
                   value="{{ old('address') }}"
                   class="w-full border rounded px-3 py-2">
            @error('address')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">نام غسال *</label>
            <input type="text" name="name"
                   value="{{ old('name') }}"
                   class="w-full border rounded px-3 py-2">
            @error('name')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">غسال کا رابطہ نمبر *</label>
            <input type="text" name="contact"
                   value="{{ old('contact') }}"
                   class="w-full border rounded px-3 py-2">
            @error('contact')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">غسل کا وقت *</label>
            <input type="text" name="time_of_ghusal"
                   value="{{ old('time_of_ghusal') }}"
                   class="w-full border rounded px-3 py-2">
            @error('time_of_ghusal')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                Save
            </button>
            <a href="{{ route('ghassal.index') }}"
               class="text-gray-600 hover:underline">
                Cancel
            </a>
        </div>
    </form>
@endsection