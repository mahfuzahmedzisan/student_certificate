<x-admin::app>
    <x-slot name="pageSlug">{{__('dashboard')}}</x-slot>
    <x-slot name="title">{{__('Admins Dashboard')}}</x-slot>
    <x-slot name="breadcrumb">{{__('Admin Dashboard')}}</x-slot>

    <livewire:backend.dashboard />
</x-admin::app>