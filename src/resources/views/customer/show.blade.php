@extends('appshell::layouts.private')

@section('title')
    {{ __('Viewing') }} {{ $customer->getName() }}
@stop

@section('content')

    <div class="card-deck mb-3">
        @component('appshell::widgets.card_with_icon', [
                'icon' => enum_icon($customer->type),
                'type' => $customer->is_active ? 'success' : 'warning'
        ])
            {{ $customer->getName() }}
            @if (!$customer->is_active)
                <small>
                        <span class="badge badge-default">
                            {{ __('inactive') }}
                        </span>
                </small>
            @endif
            @slot('subtitle')
                {{ $customer->type->label() }}
            @endslot
        @endcomponent

        @component('appshell::widgets.card_with_icon', [
                'icon' => 'time-countdown',
                'type' => $customer->last_purchase_at ? 'success' : null
        ])
            {{ __('Last purchase') }}
            <span title="{{ $customer->last_purchase_at ? $customer->last_purchase_at : '' }}">{{ $customer->last_purchase_at ? $customer->last_purchase_at->diffForHumans() : __('never') }}</span>

            @slot('subtitle')
                {{ __('Customer since') }}
                {{ $customer->created_at->format(__('Y-m-d H:i')) }}
            @endslot
        @endcomponent

        @yield('widgets')

    </div>

    @yield('cards')

    @include('appshell::address._index', ['addresses' => $customer->addresses, 'of' => $customer])

    <div class="card">
        <div class="card-body">
            @can('edit customers')
            <a href="{{ route('appshell.customer.edit', $customer) }}" class="btn btn-outline-primary">{{ __('Edit customer')
            }}</a>
            @endcan

            @yield('actions')

            @can('delete customers')
                {!! Form::open(['route' => ['appshell.customer.destroy', $customer],
                                            'method' => 'DELETE',
                                            'data-confirmation-text' => __('Are you sure to delete :name?', ['name' => $customer->getName()]),
                                            'class' => 'float-right'
                                           ])
                !!}
                    <button class="btn btn-outline-danger">
                        {{ __('Delete customer') }}
                    </button>
                {!! Form::close() !!}
            @endcan

        </div>
    </div>

@stop
