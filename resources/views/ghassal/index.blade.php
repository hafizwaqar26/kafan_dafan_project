@extends('layouts.ghassal')

@section('title', 'All Records')

@section('content')

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Ghassal Records</h1>
            <p class="text-xs text-gray-500 mt-1">
                موجودہ تمام غسال ریکارڈز کی فہرست، سرچ اور فلٹر کے ساتھ۔
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            {{-- Download dropdown (pure JS) --}}
            <div class="relative inline-block text-left">
                <button type="button"
                        onclick="document.getElementById('download-menu').classList.toggle('hidden')"
                        class="inline-flex items-center gap-1 bg-gray-700 hover:bg-gray-800 text-white px-3 py-2 rounded text-xs">
                    Download
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div id="download-menu"
                     class="hidden absolute right-0 mt-1 w-32 bg-white border border-gray-200 rounded shadow-md z-20">
                    <a href="{{ route('ghassal.export.csv', request()->query()) }}"
                       class="block px-3 py-2 text-xs text-gray-700 hover:bg-gray-100">
                        CSV
                    </a>

                    <a href="{{ route('ghassal.export.pdf', request()->query()) }}"
                       class="block px-3 py-2 text-xs text-gray-700 hover:bg-gray-100 border-t border-gray-100">
                        PDF
                    </a>
                </div>
            </div>

            {{-- New record --}}
            <a href="{{ route('ghassal.create') }}"
               class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm shadow-sm">
                <span class="text-lg leading-none">+</span>
                <span>نیا ریکارڈ شامل کریں</span>
            </a>
        </div>
    </div>

    {{-- Top mega search bar --}}
    
    <div class="mb-4">
        <form method="GET" action="{{ route('ghassal.index') }}" class="flex flex-col md:flex-row gap-2">
            <input type="text" name="q"
                   placeholder="میگا سرچ (نام، مقام، نمبر...)"
                   value="{{ request('q') }}"
                   class="flex-1 border rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500">
            <div class="flex gap-2">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">
                    Search
                </button>
                <a href="{{ route('ghassal.index') }}"
                   class="px-4 py-2 rounded text-sm border border-gray-300 text-gray-700 hover:bg-gray-100">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-sm overflow-x-auto border border-gray-100">
        <table class="min-w-full text-xs md:text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
            <tr class="text-gray-700 text-[11px] md:text-xs">
                <th class="px-3 py-2 font-semibold text-center">#</th>
                <th class="px-3 py-2 font-semibold text-right">ملک</th>
                <th class="px-3 py-2 font-semibold text-right">صوبہ</th>
                <th class="px-3 py-2 font-semibold text-right">ڈویژن</th>
                <th class="px-3 py-2 font-semibold text-right">ڈسٹرکٹ/میٹروپولیٹن</th>
                <th class="px-3 py-2 font-semibold text-right">تحصیل/ٹاؤن/زون</th>
                <th class="px-3 py-2 font-semibold text-right">سب تحصیل/سب ٹاؤن/ایریا</th>
                <th class="px-3 py-2 font-semibold text-right">یوسی/سیکٹر</th>
                <th class="px-3 py-2 font-semibold text-right">مقام</th>
                <th class="px-3 py-2 font-semibold text-right">نام غسال</th>
                <th class="px-3 py-2 font-semibold text-right">غسال کا رابطہ نمبر</th>
                <th class="px-3 py-2 font-semibold text-right">غسل کا وقت</th>
                <th class="px-3 py-2 font-semibold text-center">Actions</th>
            </tr>

            {{-- Column-wise search row --}}
            <tr class="bg-gray-50 border-t border-gray-200">
                <form method="GET" action="{{ route('ghassal.index') }}">
                    {{-- نمبر شمار کیلئے empty --}}
                    <th class="px-3 py-1"></th>

                    <th class="px-3 py-1">
                        <input type="text" name="country" placeholder="ملک"
                               value="{{ request('country') }}"
                               class="w-full border rounded px-2 py-1 text-[11px] text-right focus:outline-none focus:ring-1 focus:ring-indigo-400">
                    </th>
                    <th class="px-3 py-1">
                        <input type="text" name="province" placeholder="صوبہ"
                               value="{{ request('province') }}"
                               class="w-full border rounded px-2 py-1 text-[11px] text-right focus:outline-none focus:ring-1 focus:ring-indigo-400">
                    </th>
                    <th class="px-3 py-1">
                        <input type="text" name="division" placeholder="ڈویژن"
                               value="{{ request('division') }}"
                               class="w-full border rounded px-2 py-1 text-[11px] text-right focus:outline-none focus:ring-1 focus:ring-indigo-400">
                    </th>
                    <th class="px-3 py-1">
                        <input type="text" name="district" placeholder="ڈسٹرکٹ"
                               value="{{ request('district') }}"
                               class="w-full border rounded px-2 py-1 text-[11px] text-right focus:outline-none focus:ring-1 focus:ring-indigo-400">
                    </th>
                    <th class="px-3 py-1">
                        <input type="text" name="tehsil" placeholder="تحصیل"
                               value="{{ request('tehsil') }}"
                               class="w-full border rounded px-2 py-1 text-[11px] text-right focus:outline-none focus:ring-1 focus:ring-indigo-400">
                    </th>
                    <th class="px-3 py-1">
                        <input type="text" name="sub_tehsil" placeholder="سب تحصیل"
                               value="{{ request('sub_tehsil') }}"
                               class="w-full border rounded px-2 py-1 text-[11px] text-right focus:outline-none focus:ring-1 focus:ring-indigo-400">
                    </th>
                    <th class="px-3 py-1">
                        <input type="text" name="uc" placeholder="یوسی"
                               value="{{ request('uc') }}"
                               class="w-full border rounded px-2 py-1 text-[11px] text-right focus:outline-none focus:ring-1 focus:ring-indigo-400">
                    </th>
                    <th class="px-3 py-1">
                        <input type="text" name="address" placeholder="مقام"
                               value="{{ request('address') }}"
                               class="w-full border rounded px-2 py-1 text-[11px] text-right focus:outline-none focus:ring-1 focus:ring-indigo-400">
                    </th>
                    <th class="px-3 py-1">
                        <input type="text" name="name" placeholder="نام"
                               value="{{ request('name') }}"
                               class="w-full border rounded px-2 py-1 text-[11px] text-right focus:outline-none focus:ring-1 focus:ring-indigo-400">
                    </th>
                    <th class="px-3 py-1">
                        <input type="text" name="contact" placeholder="نمبر"
                               value="{{ request('contact') }}"
                               class="w-full border rounded px-2 py-1 text-[11px] text-right focus:outline-none focus:ring-1 focus:ring-indigo-400">
                    </th>
                    <th class="px-3 py-1">
                        <input type="text" name="time_of_ghusal" placeholder="وقت"
                               value="{{ request('time_of_ghusal') }}"
                               class="w-full border rounded px-2 py-1 text-[11px] text-right focus:outline-none focus:ring-1 focus:ring-indigo-400">
                    </th>

                    <th class="px-3 py-1 text-center">
                        <button type="submit"
                                class="bg-gray-700 hover:bg-gray-800 text-white px-3 py-1 rounded text-[11px]">
                            Filter
                        </button>
                    </th>
                </form>
            </tr>
            </thead>

            <tbody>
            @forelse($records as $record)
                <tr class="border-t border-gray-100 hover:bg-gray-50">
                    {{-- Descending نمبر شمار with pagination --}}
                    <td class="px-3 py-2 text-center text-gray-700">
                        {{ ($records->total() - ($records->firstItem() + $loop->index)) + 1 }}
                    </td>

                    <td class="px-3 py-2 whitespace-nowrap text-right">{{ $record->country }}</td>
                    <td class="px-3 py-2 whitespace-nowrap text-right">{{ $record->province }}</td>
                    <td class="px-3 py-2 whitespace-nowrap text-right">{{ $record->division }}</td>
                    <td class="px-3 py-2 whitespace-nowrap text-right">{{ $record->district }}</td>
                    <td class="px-3 py-2 whitespace-nowrap text-right">{{ $record->tehsil }}</td>
                    <td class="px-3 py-2 whitespace-nowrap text-right">{{ $record->sub_tehsil }}</td>
                    <td class="px-3 py-2 whitespace-nowrap text-right">{{ $record->uc }}</td>
                    <td class="px-3 py-2 whitespace-nowrap text-right">{{ $record->address }}</td>
                    <td class="px-3 py-2 whitespace-nowrap text-right">{{ $record->name }}</td>
                    <td class="px-3 py-2 whitespace-nowrap text-right">{{ $record->contact }}</td>
                    <td class="px-3 py-2 whitespace-nowrap text-right">{{ $record->time_of_ghusal }}</td>

                    <td class="px-3 py-2 whitespace-nowrap">
                        <div class="flex items-center justify-center gap-2">
                            {{-- Edit icon --}}
                            <a href="{{ route('ghassal.edit', $record) }}"
                               class="text-indigo-600 hover:text-indigo-800"
                               title="ترمیم">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-4 w-4 md:h-5 md:w-5"
                                     viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793z" />
                                    <path d="M4 13.25V16h2.75L14.81 7.94l-2.75-2.75L4 13.25z" />
                                </svg>
                            </a>

                            {{-- Delete icon --}}
                            <form method="POST"
                                  action="{{ route('ghassal.destroy', $record) }}"
                                  onsubmit="return confirm('Delete this record?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:text-red-800"
                                        title="حذف">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="h-4 w-4 md:h-5 md:w-5"
                                         viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 100 2h.293l.853 10.238A2 2 0 007.138 18h5.724a2 2 0 001.992-1.762L15.707 6H16a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zm1 5a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1zm-3 1a1 1 0 011 1v6a1 1 0 11-2 0V9a1 1 0 011-1zm7 0a1 1 0 00-1 1v6a1 1 0 102 0V9a1 1 0 00-1-1z"
                                              clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="13" class="px-3 py-4 text-center text-gray-500">
                        فی الحال کوئی ریکارڈ موجود نہیں۔
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $records->links() }}
    </div>
@endsection