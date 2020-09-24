<div class="form-group row">
    <label for="phone" class="col-md-4 col-form-label text-md-right">Namba ya simu</label>

    <div class="col-md-6">
        <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>

        @if ($errors->has('phone'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
        @endif
        <small>Weka namba moja tu, tafadhali usisahau kuweka code ya nchi (ya Tanzania ni +255 au Kenya ni +254 n.k.) mfano +<strong>255</strong>711123456 au +<strong>254</strong>711123456</small>
    </div>

</div>
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
