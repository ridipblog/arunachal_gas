@props([
    'title' => null,
    'message' => null,
    'details' => null,
    'retryUrl' => null,
    'actionText' => null,
    'showDashboardLink' => true,
    'compact' => false,
])

<x-admin.error-state 
    :title="$title ?? 'Something went wrong'"
    :message="$message ?? 'We encountered an unexpected error while loading this section. Please try refreshing or return to the dashboard.'"
    :details="$details"
    :retry-url="$retryUrl"
    :action-text="$actionText ?? 'Refresh Page'"
    :show-dashboard-link="$showDashboardLink"
    :compact="$compact"
    {{ $attributes }}
>
    {{ $slot }}
</x-admin.error-state>
