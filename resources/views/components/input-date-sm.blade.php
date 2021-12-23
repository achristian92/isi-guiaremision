<input type="date" id="{{ $name }}" name="{{ $name }}" class="form-control form-control-sm"
       @if($errors->has($name)) class="text-neg" @endif
       @if(isset($placeholder)) placeholder="{{$placeholder}}" @endif
       @if(isset($tabindex)) tabindex="{{$tabindex}}" @endif
       @if(isset($model) || old($name)) value="{{ old($name) ? old($name) : ($model->$name ? $model->$name->format('Y-m-d') : $model->$name)}}" @endif
       @if(isset($required)) required @endif />
