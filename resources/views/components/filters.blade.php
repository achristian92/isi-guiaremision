
<form action="{{ $route }}" method="get">
    <div class="input-group">
        <input type="text"
               name="q"
               value="{{ request()->input('q') }}"
               placeholder="{{ $text ?? 'Buscar por código o nombres...'}}"
               class="form-control">
        <div class="input-group-append">
            <button class="btn btn-outline-light" type="submit">
                <i class="ti-search"></i>
            </button>
        </div>
    </div>
</form>
