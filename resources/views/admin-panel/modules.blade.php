@php
    use Modules\DataTable\app\Http\Livewire\DataTable\Base\BaseDataTable;

    $relevantUserId = Auth::id();
    $objectInstanceDefaultValues = [
        'user_id' => $relevantUserId,
    ];
    $livewireTableOptions = [
        'editable' => true,
        'selectable' => false,
        'hasCommands' => true,
        'renderMode' => BaseDataTable::RENDER_MODE_BACKEND,
    ];
    $livewireTable = 'website-base::data-table.module';
    $livewireForm = 'website-base::form.module';
    //$formObjectId = null;
    //$isFormOpen = false;
@endphp
@include('website-base::components.data-tables.tables.split-dt-with-form')
