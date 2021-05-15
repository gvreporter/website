<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label{{ ($error ?? false) ? ' is-invalid' : '' }}">
    <input
        class="mdl-textfield__input"
        id="{{ $id }}"
        name="{{ $name }}"
        autocomplete="{{ $autocomplete ?? 'off' }}"
        type="{{ $type ?? 'text' }}"
        value="{{ $value ?? '' }}"
        @if ($required ?? false)
            data-required 
        @endif
        @if ($autofocus ?? false)
            autofocus=""
        @endif
    >
    <label class="mdl-textfield__label" for="{{ $id }}">{{ $label }}</label>
    @if ($error ?? false)
        <span class="mdl-textfield__error">{{ $error }}</span>
    @endif
</div>