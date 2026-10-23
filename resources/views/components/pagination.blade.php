@php
    use Modules\SystemBase\app\Http\Livewire\Pagination;

    /**
     * @var Pagination $this
     */
@endphp
<div>
    @if ($this->maxPages)
        <nav aria-label="Page navigation">
            <ul class="w-full flex pagination layout-flex-responsive">
                @if ($this->showStartEndNavigation)
                    <x-theme-ui::pagination.item :disabled="($this->currentPage <= 1)" icon="chevrons-left" link="1" class="rounded-l-full"/>
                @endif
                <x-theme-ui::pagination.item :disabled="($this->currentPage <= 1)" icon="chevron-left" :link="$this->prevPage"/>
                @if ($this->showContinueMark && $this->loopStart > 1)
                    <x-theme-ui::pagination.item icon="ellipsis"/>
                @endif
                @for ($page = $this->loopStart; $page <= $this->loopEnd; $page++)
                    <x-theme-ui::pagination.item :active="($page == $this->currentPage)" :label="$page" :link="$page"/>
                @endfor
                @if ($this->showContinueMark && $this->loopEnd < $this->maxPages)
                    <x-theme-ui::pagination.item icon="ellipsis"/>
                @endif
                <x-theme-ui::pagination.item :disabled="($this->currentPage >= $this->loopEnd)" icon="chevron-right" :link="$this->nextPage"/>
                @if ($this->showStartEndNavigation)
                    <x-theme-ui::pagination.item :disabled="($this->currentPage >= $this->loopEnd)" icon="chevrons-right" :link="$this->maxPages" class="rounded-r-full"/>
                @endif
                @if ($this->showInfo)
                    <li class="page-item disabled show-md text-nowrap my-auto ml-1 text-sm">
                        {{ sprintf(__('Page :page of :total', ['page' => $this->currentPage, 'total' => $this->maxPages])) }}
                    </li>
                    <li class="page-item disabled hide-md text-nowrap my-auto ml-1 text-sm">
                        {{ sprintf(__(':page/:total', ['page' => $this->currentPage, 'total' => $this->maxPages])) }}
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>