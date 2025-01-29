<div id="additional-services">
<h3 class="p-3">Additional Services :</h3>
  <table class="table">
    <tr>
        <td>VGM :</td>
        <td>
        <input type="checkbox" id="listcheckbox-vgm" name="vgm" disabled class="listcheckbox filled-in chk-col-light-blue" @if($document->vgm === 'on') checked @endif />
            <label for="listcheckbox-vgm"></label>
        </td>
        <td>
            <input type="text" name="vgm_price" id="vgm_price" class="form-control" disabled placeholder="Price" value="{{ $document->vgm_price }}"/>
        </td>
    </tr>
    <tr>
        <td>ADR / IMO :</td>
        <td>
            <input type="checkbox" id="listcheckbox-adr" name="adr" disabled class="listcheckbox filled-in chk-col-light-blue" @if($document->adr === 'on') checked @endif/>
            <label for="listcheckbox-adr"></label>
        </td>
        <td>
            <input type="text" name="adr_price" id="adr_price" class="form-control" disabled placeholder="Price" value="{{ $document->adr_price }}"/>
        </td>
    </tr>
    <tr>
        <td>T1 :</td>
        <td>
            <input type="checkbox" id="listcheckbox-t1" name="t1" disabled class="listcheckbox filled-in chk-col-light-blue" @if($document->t1 === 'on') checked @endif />
            <label for="listcheckbox-t1"></label>
        </td>
        <td>
            <input type="text" name="t1_price" id="t1_price" class="form-control" disabled placeholder="Price" value="{{ $document->t1_price }}"/>
        </td>
    </tr>
    <tr>
        <td>TCC :</td>
        <td>
            <input type="checkbox" id="listcheckbox-tcc" name="tcc" disabled class="listcheckbox filled-in chk-col-light-blue" @if($document->tcc === 'on') checked @endif/>
            <label for="listcheckbox-tcc"></label>
        </td>
        <td>
            <input type="text" name="tcc_price" id="tcc_price" class="form-control" disabled placeholder="Price" value="{{ $document->tcc_price }}"/>
        </td>
    </tr>
    <tr>
        <td>Weight :</td>
        <td>
            <select name="weight" id="weight" class="form-control" disabled>
                <option value="normal"  {{ $document->weight === 'normal' ? 'selected' : '' }}>Normal</option>
                <option value="heavy" {{ $document->weight === 'heavy' ? 'selected' : '' }}>Heavy</option>
                <option value="extra_heavy" {{ $document->weight === 'extra_heavy' ? 'selected' : '' }}>Extra Heavy</option>
            </select>
        </td>
        <td>
            <input type="text" name="weight_price" class="form-control" disabled placeholder="Price"  value="{{ $document->weight_price }}"/>
        </td>
    </tr>
</table>
</div>

