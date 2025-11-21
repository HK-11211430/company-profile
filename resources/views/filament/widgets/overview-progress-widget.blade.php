<div class="p-4 bg-white/60 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-100 dark:bg-gray-800/60 dark:border-gray-700">
    <div class="flex items-start justify-between gap-6">
        <div class="flex-1">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-semibold text-gray-700 dark:text-gray-300">Overview Konten</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Ringkasan status pemasukan konten</div>
                </div>
                <div class="text-sm text-gray-500 dark:text-gray-400">{{ now()->format('d M Y') }}</div>
            </div>

            <div class="mt-4 grid grid-cols-1 gap-4">
                <!-- Galeri -->
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-linear-to-br from-{{ $data['galeri']['color_from'] }} to-{{ $data['galeri']['color_to'] }} text-white">
                        <!-- small camera icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M3 7h2l2-3h6l2 3h2a2 2 0 012 2v9a2 2 0 01-2 2H3a2 2 0 01-2-2V9a2 2 0 012-2z" />
                        </svg>
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm font-medium text-gray-700 dark:text-gray-300">Galeri</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ number_format($data['galeri']['total']) }} item</div>
                            </div>
                            <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $data['galeri']['percent'] }}%</div>
                        </div>

                        <div class="mt-2">
                            <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                                <div class="h-2 bg-linear-to-r from-{{ $data['galeri']['color_from'] }} to-{{ $data['galeri']['color_to'] }} transition-all duration-700 ease-in-out" style="width: {{ $data['galeri']['percent'] }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Artikel -->
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-linear-to-br from-{{ $data['artikel']['color_from'] }} to-{{ $data['artikel']['color_to'] }} text-white">
                        <!-- small document icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M16 3H8a2 2 0 00-2 2v14a2 2 0 002 2h8a2 2 0 002-2V7l-4-4z" />
                        </svg>
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm font-medium text-gray-700 dark:text-gray-300">Artikel</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ number_format($data['artikel']['total']) }} item</div>
                            </div>
                            <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $data['artikel']['percent'] }}%</div>
                        </div>

                        <div class="mt-2">
                            <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                                <div class="h-2 bg-linear-to-r from-{{ $data['artikel']['color_from'] }} to-{{ $data['artikel']['color_to'] }} transition-all duration-700 ease-in-out" style="width: {{ $data['artikel']['percent'] }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-40 flex-none">
            <div class="bg-white rounded-lg p-3 shadow-sm border dark:bg-gray-800 dark:border-gray-600">
                <div class="text-xs text-gray-500 dark:text-gray-400">Tindakan</div>
                <div class="mt-2 grid gap-2">
                    <a href="{{ $data['galeri']['resource'] }}" class="text-xs text-indigo-600 hover:underline dark:text-indigo-400">Lihat Galeri</a>
                    <a href="{{ $data['artikel']['resource'] }}" class="text-xs text-emerald-600 hover:underline dark:text-emerald-400">Lihat Artikel</a>
                </div>
            </div>
        </div>
    </div>
</div>
