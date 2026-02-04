<section>
    {{-- Page Header --}}
    <div class="glass-card rounded-2xl p-4 lg:p-6 mb-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <h2 class="text-xl lg:text-2xl font-bold text-text-primary">
                {{ __('Student List') }}
            </h2>
            <div class="flex items-center gap-2 w-full sm:w-auto">
                <x-ui.button href="{{ route('student.trash') }}" variant='tertiary' class="w-auto py-2!">
                    <flux:icon name="trash"
                        class="w-4 h-4 stroke-text-btn-primary group-hover:stroke-text-btn-tertiary" />
                    {{ __('Trash') }}
                </x-ui.button>
                <x-ui.button href="{{ route('student.create') }}" class="w-auto py-2!">
                    <flux:icon name="user-plus"
                        class="w-4 h-4 stroke-text-btn-primary group-hover:stroke-text-btn-secondary" />
                    {{ __('Add') }}
                </x-ui.button>
            </div>
        </div>
    </div>

    {{-- Table Component --}}
    <x-ui.table :data="$datas" :columns="$columns" :actions="$actions" :bulkActions="$bulkActions" :bulkAction="$bulkAction"
        :statuses="$statuses" :selectedIds="$selectedIds" :mobileVisibleColumns="2" searchProperty="search" perPageProperty="perPage"
        :showBulkActions="true" emptyMessage="{{ __('No students found. Create your first student to get started.') }}" />

    {{-- Delete Confirmation Modal --}}
    <x-ui.confirmation-modal :show="'showDeleteModal'" title="{{ __('Delete this student?') }}"
        message="{{ __('Are you sure you want to remove this student?') }}" :method="'delete'"
        button-text="{{ __('Delete Student') }}" />

    {{-- Bulk Action Confirmation Modal --}}
    <x-ui.confirmation-modal :show="'showBulkActionModal'" title="{{ __('Confirm Bulk Action') }}"
        message="{{ __('Are you sure you want to perform this action on ' . count($selectedIds) . ' selected student(s)?') }}"
        :method="'executeBulkAction'" button-text="{{ __('Confirm Action') }}" />
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('download-pdf', (base64Data, fileName) => {
                const link = document.createElement('a');
                link.href = 'data:application/pdf;base64,' + base64Data;
                link.download = fileName;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
        });
    </script>
</section>
