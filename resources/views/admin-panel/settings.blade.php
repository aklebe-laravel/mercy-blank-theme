@php
    use Illuminate\Support\Facades\Auth;
    use Modules\WebsiteBase\app\Services\CoreConfigService;

    /**
     * @var CoreConfigService $config
     * @var string $livewireForm like "my-module-form-user"
     * @var string $livewireTable like "my-module-data-table-user"
     */

    $relevantUserId = Auth::id();
    $livewireForm = 'website-base::form.core-config';
    $livewireTable = 'website-base::data-table.core-config';
    $modelName = 'CoreConfig';
    $formObjectId = null;
    $isFormOpen = false;
    $objectInstanceDefaultValues = [
        'user_id' => $relevantUserId,
    ];
@endphp
@include('website-base::components.data-tables.tables.split-dt-with-form')