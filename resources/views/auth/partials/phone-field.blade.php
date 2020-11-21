<div class="form-group row">
    <label for="phone" class="col-md-4 col-form-label text-md-right">Namba ya simu moja tu</label>

    <div class="col-md-6">
        <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>

        @if ($errors->has('phone'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
        @endif
        <small>Weka namba moja tu</small>
    </div>

</div>
@include('auth.partials.select-country', ['labelFor' => 'register'])
<div class="form-group row">
    <label class="form-check-label col-md-4 col-form-label text-md-right" for="has_whatsapp">
        Namba hii ina WhatsApp
    </label>
    <div class="col-md-6">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="has_whatsapp" id="has_whatsapp" value="1" checked>
            <label class="form-check-label" for="has_whatsapp">
                Ndio
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="has_whatsapp" id="has_no_whatsapp" value="0">
            <label class="form-check-label" for="has_no_whatsapp">
                Hapana
            </label>
        </div>
    </div>
</div>
