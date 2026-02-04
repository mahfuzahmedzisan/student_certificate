<x-admin::app>
    <x-slot name="pageSlug">{{__('student')}}</x-slot>

    @switch(Route::currentRouteName())
        @case('student.create')
            <x-slot name="title">{{__('Students Create')}}</x-slot>
            <x-slot name="breadcrumb">{{__('Student Create')}}</x-slot>
            <livewire:backend.student.create />
        @break

        @case('student.edit')
            <x-slot name="title">{{__('Students Edit')}}</x-slot>
            <x-slot name="breadcrumb">{{__('Student Edit')}}</x-slot>
            <livewire:backend.student.edit :model="$data"/>
        @break

        @case('student.trash')
            <x-slot name="title">{{__('Students Trash')}}</x-slot>
            <x-slot name="breadcrumb">{{__('Student Trash')}}</x-slot>
            <livewire:backend.student.trash />
        @break

        @case('student.view')
            <x-slot name="title">{{__('Students View')}}</x-slot>
            <x-slot name="breadcrumb">{{__('Student View')}}</x-slot>
            <livewire:backend.student.view :model="$data"/>
        @break

        @default
            <x-slot name="title">{{__('Students List')}}</x-slot>
            <x-slot name="breadcrumb">{{__('Student List')}}</x-slot>
            <livewire:backend.student.index />
    @endswitch

</x-admin::app>
