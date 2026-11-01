<div
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-surface-200/50 backdrop-blur-md"
        x-show="messageBox.isOpen"
        x-on:keydown.escape.window="messageBox.isOpen = false"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        role="dialog"
        aria-modal="true"
        tabindex="-1"
>
    {{-- click.outside sits on the dialog, not on the backdrop: the backdrop covers the whole screen, so a click could never be "outside" of it --}}
    <div class="w-full max-w-lg max-h-[85vh] flex flex-col bg-surface-50 border border-surface-200/60 rounded-xl shadow-2xl ring-1 ring-surface-950/5 overflow-hidden"
         x-on:click.outside="messageBox.isOpen = false"
    >
        <div class="flex items-start justify-between px-6 pt-6 pb-3 bg-surface-50">
            <h5 class="text-xl font-bold tracking-tight text-primary-950" x-text="messageBox.title"></h5>
            <button
                    type="button"
                    x-on:click="messageBox.isOpen = false"
                    class="p-1 rounded-lg text-secondary-500 hover:text-primary-950 hover:bg-surface-100 transition-all cursor-pointer"
                    aria-label="{{ __('Close') }}"
            >
                <x-lucide-x class="w-5 h-5"/>
            </button>
        </div>

        <div class="flex-1 px-6 py-3 overflow-y-auto text-secondary-700 text-sm leading-relaxed antialiased bg-surface-50">
            <div x-html="messageBox.content" class="space-y-3"></div>
        </div>

        <div class="flex items-center justify-end gap-3 px-6 py-5 bg-surface-50">
            <template x-for="value in messageBox.actions">
                <span x-html="value" class="contents"></span>
            </template>
        </div>
    </div>
</div>
