<a
    href="{{ $cancel_url ?? route('admin.application.index') }}"
    class="btn btn-sm btn-solid"
><i class="fa-solid fa-close"></i> Cancel</a>

@if ($demo)
    <button
        type="button"
        class="btn btn-sm btn-solid"
        {{ $readonly ? 'disabled' : '' }}
        onclick="alert('You cannot update data because the site is in demo mode.')"
    ><i class="fa-solid fa-floppy-disk"></i> Update</button>
@else
    <button
        type="submit"
        class="btn btn-sm btn-solid"
        {{ $readonly ? 'disabled' : '' }}
    ><i class="fa-solid fa-floppy-disk"></i> Submit</button>
@endif
