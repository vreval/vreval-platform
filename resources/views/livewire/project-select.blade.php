<div>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
    </form>
</div>

@script
<script>
    $wire.on('refresh-page', () => window.location.reload());
</script>
@endscript
