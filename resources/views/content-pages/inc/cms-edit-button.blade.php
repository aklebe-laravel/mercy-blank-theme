@php
    use Modules\WebsiteBase\app\Http\Livewire\Form\CmsContent;
    use \Modules\WebsiteBase\app\Http\Livewire\Form\CmsPage;

    /** @var string $cmsModelName */
    /** @var CmsContent|CmsPage $cmsModel */
    /** @var int $id */
@endphp
<span class="cms-edit-button" title="{{ $cmsModel->code }}">
    <a href="{{ route('manage-data', ['modelName' => $cmsModelName, 'modelId' => $id]) }}"
       class="btn-sm btn-primary">
        <x-lucide-notebook-pen class="h-5 w-5"/>
    </a>
</span>