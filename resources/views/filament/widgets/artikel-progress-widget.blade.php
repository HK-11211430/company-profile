<div class="relative w-full max-w-xl overflow-hidden rounded-2xl border border-primary-600 bg-white text-gray-900 shadow-lg transition-colors dark:border-white/40 dark:bg-linear-to-br dark:from-primary-500/90 dark:via-primary-500/80 dark:to-primary-700 dark:text-white">
    <div class="pointer-events-none absolute -left-14 top-1/2 hidden h-36 w-36 -translate-y-1/2 rounded-full bg-primary-200/50 blur-2xl transition-colors dark:bg-white/10 lg:block"></div>

    <div class="flex flex-col gap-3 p-4 sm:p-5">
        <div class="flex flex-col items-start gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-primary-700 transition-colors dark:text-white">Artikel</p>
                <h2 class="mt-1 text-3xl font-bold leading-tight sm:text-[32px]">{{ number_format($total) }}</h2>
                <p class="mt-1 text-xs text-primary-600/80 transition-colors sm:text-sm dark:text-white">Jumlah artikel yang tersedia untuk dibaca pengunjung.</p>
            </div>

            <div class="flex h-12 w-12 flex-none items-center justify-center rounded-xl bg-primary-100 text-primary-700 shadow-inner transition-colors sm:h-14 sm:w-14 dark:bg-white/15 dark:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-7 sm:w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5H15.75L19.5 8.25V19.5H8.25C7.00736 19.5 6 18.4926 6 17.25V6.75C6 5.50736 7.00736 4.5 8.25 4.5Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11.25H15" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25H15" />
                </svg>
            </div>
        </div>

        <div class="flex flex-col justify-between gap-3 rounded-xl bg-primary-50 p-3 text-xs text-primary-900 transition-colors sm:flex-row sm:items-center sm:gap-4 sm:p-4 sm:text-sm dark:bg-white/15 dark:text-white/85">
            <div>
                <p class="font-semibold text-primary-700 transition-colors dark:text-white">Status</p>
                <p class="font-medium">Layak terbit</p>
            </div>
            <div class="hidden h-8 w-px bg-primary-200 transition-colors sm:block dark:bg-white/20"></div>
            <div class="sm:text-right">
                <p class="font-semibold text-primary-700 transition-colors dark:text-white">Editorial</p>
                <p class="font-medium">Terjaga kualitasnya</p>
            </div>
        </div>
    </div>

    <div class="border-t border-primary-100 bg-primary-50/70 px-4 py-3 text-xs transition-colors sm:px-5 sm:py-4 sm:text-sm dark:border-white/10 dark:bg-black/5">
        <a href="{{ route('filament.admin.resources.artikels.index') }}" class="inline-flex items-center gap-2 text-primary-700 transition hover:text-primary-900 dark:text-white dark:hover:text-white">
            Kelola artikel
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5L15.75 12L8.25 19.5" />
            </svg>
        </a>
    </div>
</div>
