@include('components.errors-and-messages')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-right" >
                            {{ $actions }}
                        </div>
                    </div>
                    <br>
                    {{ $filters ?? '' }}
                    <br>
                    <div class="table-responsive table-size-12">
                        {{ $table }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
