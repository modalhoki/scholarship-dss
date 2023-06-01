<?php

namespace PHPMaker2021\lpdpdss;

// Page object
$GradedSearch = &$Page;
?>
<script>
var currentForm, currentPageID;
var fgradedsearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    <?php if ($Page->IsModal) { ?>
    fgradedsearch = currentAdvancedSearchForm = new ew.Form("fgradedsearch", "search");
    <?php } else { ?>
    fgradedsearch = currentForm = new ew.Form("fgradedsearch", "search");
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "graded")) ?>,
        fields = currentTable.fields;
    fgradedsearch.addFields([
        ["awardee", [], fields.awardee.isInvalid],
        ["total", [ew.Validators.float], fields.total.isInvalid],
        ["lgd", [ew.Validators.float], fields.lgd.isInvalid],
        ["interview", [ew.Validators.float], fields.interview.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        fgradedsearch.setInvalid();
    });

    // Validate form
    fgradedsearch.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj),
            rowIndex = "";
        $fobj.data("rowindex", rowIndex);

        // Validate fields
        if (!this.validateFields(rowIndex))
            return false;

        // Call Form_CustomValidate event
        if (!this.customValidate(fobj)) {
            this.focus();
            return false;
        }
        return true;
    }

    // Form_CustomValidate
    fgradedsearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fgradedsearch.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fgradedsearch.lists.awardee = <?= $Page->awardee->toClientList($Page) ?>;
    loadjs.done("fgradedsearch");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fgradedsearch" id="fgradedsearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="graded">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->awardee->Visible) { // awardee ?>
    <div id="r_awardee" class="form-group row">
        <label for="x_awardee" class="<?= $Page->LeftColumnClass ?>"><span id="elh_graded_awardee"><?= $Page->awardee->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_awardee" id="z_awardee" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->awardee->cellAttributes() ?>>
            <span id="el_graded_awardee" class="ew-search-field ew-search-field-single">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_awardee"><?= EmptyValue(strval($Page->awardee->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->awardee->AdvancedSearch->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->awardee->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->awardee->ReadOnly || $Page->awardee->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_awardee',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->awardee->getErrorMessage(false) ?></div>
<?= $Page->awardee->Lookup->getParamTag($Page, "p_x_awardee") ?>
<input type="hidden" is="selection-list" data-table="graded" data-field="x_awardee" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->awardee->displayValueSeparatorAttribute() ?>" name="x_awardee" id="x_awardee" value="<?= $Page->awardee->AdvancedSearch->SearchValue ?>"<?= $Page->awardee->editAttributes() ?>>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
    <div id="r_total" class="form-group row">
        <label for="x_total" class="<?= $Page->LeftColumnClass ?>"><span id="elh_graded_total"><?= $Page->total->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_total" id="z_total" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->total->cellAttributes() ?>>
            <span id="el_graded_total" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->total->getInputTextType() ?>" data-table="graded" data-field="x_total" name="x_total" id="x_total" size="30" placeholder="<?= HtmlEncode($Page->total->getPlaceHolder()) ?>" value="<?= $Page->total->EditValue ?>"<?= $Page->total->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->total->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->lgd->Visible) { // lgd ?>
    <div id="r_lgd" class="form-group row">
        <label for="x_lgd" class="<?= $Page->LeftColumnClass ?>"><span id="elh_graded_lgd"><?= $Page->lgd->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_lgd" id="z_lgd" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->lgd->cellAttributes() ?>>
            <span id="el_graded_lgd" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->lgd->getInputTextType() ?>" data-table="graded" data-field="x_lgd" name="x_lgd" id="x_lgd" size="30" maxlength="12" placeholder="<?= HtmlEncode($Page->lgd->getPlaceHolder()) ?>" value="<?= $Page->lgd->EditValue ?>"<?= $Page->lgd->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->lgd->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->interview->Visible) { // interview ?>
    <div id="r_interview" class="form-group row">
        <label for="x_interview" class="<?= $Page->LeftColumnClass ?>"><span id="elh_graded_interview"><?= $Page->interview->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_interview" id="z_interview" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->interview->cellAttributes() ?>>
            <span id="el_graded_interview" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->interview->getInputTextType() ?>" data-table="graded" data-field="x_interview" name="x_interview" id="x_interview" size="30" maxlength="12" placeholder="<?= HtmlEncode($Page->interview->getPlaceHolder()) ?>" value="<?= $Page->interview->EditValue ?>"<?= $Page->interview->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->interview->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
        <button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("Search") ?></button>
        <button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="location.reload();"><?= $Language->phrase("Reset") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("graded");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
