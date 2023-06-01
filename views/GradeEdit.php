<?php

namespace PHPMaker2021\lpdpdss;

// Page object
$GradeEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fgradeedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fgradeedit = currentForm = new ew.Form("fgradeedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "grade")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.grade)
        ew.vars.tables.grade = currentTable;
    fgradeedit.addFields([
        ["awardee", [fields.awardee.visible && fields.awardee.required ? ew.Validators.required(fields.awardee.caption) : null], fields.awardee.isInvalid],
        ["lgd", [fields.lgd.visible && fields.lgd.required ? ew.Validators.required(fields.lgd.caption) : null], fields.lgd.isInvalid],
        ["interview", [fields.interview.visible && fields.interview.required ? ew.Validators.required(fields.interview.caption) : null], fields.interview.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fgradeedit,
            fobj = f.getForm(),
            $fobj = $(fobj),
            $k = $fobj.find("#" + f.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            f.setInvalid(rowIndex);
        }
    });

    // Validate form
    fgradeedit.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj);
        if ($fobj.find("#confirm").val() == "confirm")
            return true;
        var addcnt = 0,
            $k = $fobj.find("#" + this.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1, // Check rowcnt == 0 => Inline-Add
            gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            $fobj.data("rowindex", rowIndex);

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
        }

        // Process detail forms
        var dfs = $fobj.find("input[name='detailpage']").get();
        for (var i = 0; i < dfs.length; i++) {
            var df = dfs[i],
                val = df.value,
                frm = ew.forms.get(val);
            if (val && frm && !frm.validate())
                return false;
        }
        return true;
    }

    // Form_CustomValidate
    fgradeedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fgradeedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fgradeedit.lists.lgd = <?= $Page->lgd->toClientList($Page) ?>;
    fgradeedit.lists.interview = <?= $Page->interview->toClientList($Page) ?>;
    loadjs.done("fgradeedit");
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
<form name="fgradeedit" id="fgradeedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="grade">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->awardee->Visible) { // awardee ?>
    <div id="r_awardee" class="form-group row">
        <label id="elh_grade_awardee" for="x_awardee" class="<?= $Page->LeftColumnClass ?>"><?= $Page->awardee->caption() ?><?= $Page->awardee->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->awardee->cellAttributes() ?>>
<span id="el_grade_awardee">
<span<?= $Page->awardee->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->awardee->getDisplayValue($Page->awardee->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="grade" data-field="x_awardee" data-hidden="1" name="x_awardee" id="x_awardee" value="<?= HtmlEncode($Page->awardee->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lgd->Visible) { // lgd ?>
    <div id="r_lgd" class="form-group row">
        <label id="elh_grade_lgd" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lgd->caption() ?><?= $Page->lgd->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->lgd->cellAttributes() ?>>
<span id="el_grade_lgd">
<template id="tp_x_lgd">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="grade" data-field="x_lgd" name="x_lgd" id="x_lgd"<?= $Page->lgd->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_lgd" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_lgd"
    name="x_lgd"
    value="<?= HtmlEncode($Page->lgd->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_lgd"
    data-target="dsl_x_lgd"
    data-repeatcolumn="5"
    class="form-control<?= $Page->lgd->isInvalidClass() ?>"
    data-table="grade"
    data-field="x_lgd"
    data-value-separator="<?= $Page->lgd->displayValueSeparatorAttribute() ?>"
    <?= $Page->lgd->editAttributes() ?>>
<?= $Page->lgd->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lgd->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->interview->Visible) { // interview ?>
    <div id="r_interview" class="form-group row">
        <label id="elh_grade_interview" class="<?= $Page->LeftColumnClass ?>"><?= $Page->interview->caption() ?><?= $Page->interview->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->interview->cellAttributes() ?>>
<span id="el_grade_interview">
<template id="tp_x_interview">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="grade" data-field="x_interview" name="x_interview" id="x_interview"<?= $Page->interview->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_interview" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_interview"
    name="x_interview"
    value="<?= HtmlEncode($Page->interview->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_interview"
    data-target="dsl_x_interview"
    data-repeatcolumn="5"
    class="form-control<?= $Page->interview->isInvalidClass() ?>"
    data-table="grade"
    data-field="x_interview"
    data-value-separator="<?= $Page->interview->displayValueSeparatorAttribute() ?>"
    <?= $Page->interview->editAttributes() ?>>
<?= $Page->interview->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->interview->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="grade" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("grade");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
