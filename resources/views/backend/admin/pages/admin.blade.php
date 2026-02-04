<x-admin::app>
    <x-slot name="pageSlug">{{__('admin')}}</x-slot>

    @switch(Route::currentRouteName())
        @case('admin.create')
            <x-slot name="title">{{__('Admins Create')}}</x-slot>
            <x-slot name="breadcrumb">{{__('Admin Create')}}</x-slot>
            <livewire:backend.admin.create />
        @break

        @case('admin.edit')
            <x-slot name="title">{{__('Admins Edit')}}</x-slot>
            <x-slot name="breadcrumb">{{__('Admin Edit')}}</x-slot>
            <livewire:backend.admin.edit :model="$data"/>
        @break

        @case('admin.trash')
            <x-slot name="title">{{__('Admins Trash')}}</x-slot>
            <x-slot name="breadcrumb">{{__('Admin Trash')}}</x-slot>
            <livewire:backend.admin.trash />
        @break

        @case('admin.view')
            <x-slot name="title">{{__('Admins View')}}</x-slot>
            <x-slot name="breadcrumb">{{__('Admin View')}}</x-slot>
            <livewire:backend.admin.view :model="$data"/>
        @break

        @default
            <x-slot name="title">{{__('Admins List')}}</x-slot>
            <x-slot name="breadcrumb">{{__('Admin List')}}</x-slot>
            <livewire:backend.admin.index />
    @endswitch

</x-admin::app>
