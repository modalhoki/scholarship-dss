<?php

namespace PHPMaker2021\lpdpdss;

// Page object
$GradeAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fgradeadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fgradeadd = currentForm = new ew.Form("fgradeadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "grade")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.grade)
        ew.vars.tables.grade = currentTable;
    fgradeadd.addFields([
        ["awardee", [fields.awardee.visible && fields.awardee.required ? ew.Validators.required(fields.awardee.caption) : null], fields.awardee.isInvalid],
        ["international", [fields.international.visible && fields.international.required ? ew.Validators.required(fields.international.caption) : null], fields.international.isInvalid],
        ["national", [fields.national.visible && fields.national.required ? ew.Validators.required(fields.national.caption) : null], fields.national.isInvalid],
        ["community", [fields.community.visible && fields.community.required ? ew.Validators.required(fields.community.caption) : null], fields.community.isInvalid],
        ["experience", [fields.experience.visible && fields.experience.required ? ew.Validators.required(fields.experience.caption) : null], fields.experience.isInvalid],
        ["gpa", [fields.gpa.visible && fields.gpa.required ? ew.Validators.required(fields.gpa.caption) : null], fields.gpa.isInvalid],
        ["scolastic", [fields.scolastic.visible && fields.scolastic.required ? ew.Validators.required(fields.scolastic.caption) : null], fields.scolastic.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fgradeadd,
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
    fgradeadd.validate = function () {
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
    fgradeadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fgradeadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fgradeadd.lists.awardee = <?= $Page->awardee->toClientList($Page) ?>;
    fgradeadd.lists.international = <?= $Page->international->toClientList($Page) ?>;
    fgradeadd.lists.national = <?= $Page->national->toClientList($Page) ?>;
    fgradeadd.lists.community = <?= $Page->community->toClientList($Page) ?>;
    fgradeadd.lists.experience = <?= $Page->experience->toClientList($Page) ?>;
    fgradeadd.lists.gpa = <?= $Page->gpa->toClientList($Page) ?>;
    fgradeadd.lists.scolastic = <?= $Page->scolastic->toClientList($Page) ?>;
    loadjs.done("fgradeadd");
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
<form name="fgradeadd" id="fgradeadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="grade">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->awardee->Visible) { // awardee ?>
    <div id="r_awardee" class="form-group row">
        <label id="elh_grade_awardee" for="x_awardee" class="<?= $Page->LeftColumnClass ?>"><?= $Page->awardee->caption() ?><?= $Page->awardee->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->awardee->cellAttributes() ?>>
<span id="el_grade_awardee">
<div class="input-group ew-lookup-list" aria-describedby="x_awardee_help">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_awardee"><?= EmptyValue(strval($Page->awardee->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->awardee->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->awardee->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->awardee->ReadOnly || $Page->awardee->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_awardee',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
        <button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_awardee" title="<?= HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $Page->awardee->caption() ?>" data-title="<?= $Page->awardee->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_awardee',url:'<?= GetUrl("awardeeaddopt") ?>'});"><i class="fas fa-plus ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->awardee->getErrorMessage() ?></div>
<?= $Page->awardee->getCustomMessage() ?>
<?= $Page->awardee->Lookup->getParamTag($Page, "p_x_awardee") ?>
<input type="hidden" is="selection-list" data-table="grade" data-field="x_awardee" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->awardee->displayValueSeparatorAttribute() ?>" name="x_awardee" id="x_awardee" value="<?= $Page->awardee->CurrentValue ?>"<?= $Page->awardee->editAttributes() ?>>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->international->Visible) { // international ?>
    <div id="r_international" class="form-group row">
        <label id="elh_grade_international" class="<?= $Page->LeftColumnClass ?>"><?= $Page->international->caption() ?><?= $Page->international->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->international->cellAttributes() ?>>
<span id="el_grade_international">
<template id="tp_x_international">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="grade" data-field="x_international" name="x_international" id="x_international"<?= $Page->international->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_international" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_international"
    name="x_international"
    value="<?= HtmlEncode($Page->international->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_international"
    data-target="dsl_x_international"
    data-repeatcolumn="5"
    class="form-control<?= $Page->international->isInvalidClass() ?>"
    data-table="grade"
    data-field="x_international"
    data-value-separator="<?= $Page->international->displayValueSeparatorAttribute() ?>"
    <?= $Page->international->editAttributes() ?>>
<?= $Page->international->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->international->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->national->Visible) { // national ?>
    <div id="r_national" class="form-group row">
        <label id="elh_grade_national" class="<?= $Page->LeftColumnClass ?>"><?= $Page->national->caption() ?><?= $Page->national->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->national->cellAttributes() ?>>
<span id="el_grade_national">
<template id="tp_x_national">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="grade" data-field="x_national" name="x_national" id="x_national"<?= $Page->national->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_national" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_national"
    name="x_national"
    value="<?= HtmlEncode($Page->national->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_national"
    data-target="dsl_x_national"
    data-repeatcolumn="5"
    class="form-control<?= $Page->national->isInvalidClass() ?>"
    data-table="grade"
    data-field="x_national"
    data-value-separator="<?= $Page->national->displayValueSeparatorAttribute() ?>"
    <?= $Page->national->editAttributes() ?>>
<?= $Page->national->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->national->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->community->Visible) { // community ?>
    <div id="r_community" class="form-group row">
        <label id="elh_grade_community" class="<?= $Page->LeftColumnClass ?>"><?= $Page->community->caption() ?><?= $Page->community->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->community->cellAttributes() ?>>
<span id="el_grade_community">
<template id="tp_x_community">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="grade" data-field="x_community" name="x_community" id="x_community"<?= $Page->community->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_community" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_community"
    name="x_community"
    value="<?= HtmlEncode($Page->community->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_community"
    data-target="dsl_x_community"
    data-repeatcolumn="5"
    class="form-control<?= $Page->community->isInvalidClass() ?>"
    data-table="grade"
    data-field="x_community"
    data-value-separator="<?= $Page->community->displayValueSeparatorAttribute() ?>"
    <?= $Page->community->editAttributes() ?>>
<?= $Page->community->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->community->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->experience->Visible) { // experience ?>
    <div id="r_experience" class="form-group row">
        <label id="elh_grade_experience" class="<?= $Page->LeftColumnClass ?>"><?= $Page->experience->caption() ?><?= $Page->experience->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->experience->cellAttributes() ?>>
<span id="el_grade_experience">
<template id="tp_x_experience">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="grade" data-field="x_experience" name="x_experience" id="x_experience"<?= $Page->experience->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_experience" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_experience"
    name="x_experience"
    value="<?= HtmlEncode($Page->experience->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_experience"
    data-target="dsl_x_experience"
    data-repeatcolumn="5"
    class="form-control<?= $Page->experience->isInvalidClass() ?>"
    data-table="grade"
    data-field="x_experience"
    data-value-separator="<?= $Page->experience->displayValueSeparatorAttribute() ?>"
    <?= $Page->experience->editAttributes() ?>>
<?= $Page->experience->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->experience->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gpa->Visible) { // gpa ?>
    <div id="r_gpa" class="form-group row">
        <label id="elh_grade_gpa" class="<?= $Page->LeftColumnClass ?>"><?= $Page->gpa->caption() ?><?= $Page->gpa->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->gpa->cellAttributes() ?>>
<span id="el_grade_gpa">
<template id="tp_x_gpa">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="grade" data-field="x_gpa" name="x_gpa" id="x_gpa"<?= $Page->gpa->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_gpa" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_gpa"
    name="x_gpa"
    value="<?= HtmlEncode($Page->gpa->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_gpa"
    data-target="dsl_x_gpa"
    data-repeatcolumn="5"
    class="form-control<?= $Page->gpa->isInvalidClass() ?>"
    data-table="grade"
    data-field="x_gpa"
    data-value-separator="<?= $Page->gpa->displayValueSeparatorAttribute() ?>"
    <?= $Page->gpa->editAttributes() ?>>
<?= $Page->gpa->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gpa->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->scolastic->Visible) { // scolastic ?>
    <div id="r_scolastic" class="form-group row">
        <label id="elh_grade_scolastic" class="<?= $Page->LeftColumnClass ?>"><?= $Page->scolastic->caption() ?><?= $Page->scolastic->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->scolastic->cellAttributes() ?>>
<span id="el_grade_scolastic">
<template id="tp_x_scolastic">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="grade" data-field="x_scolastic" name="x_scolastic" id="x_scolastic"<?= $Page->scolastic->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_scolastic" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_scolastic"
    name="x_scolastic"
    value="<?= HtmlEncode($Page->scolastic->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_scolastic"
    data-target="dsl_x_scolastic"
    data-repeatcolumn="5"
    class="form-control<?= $Page->scolastic->isInvalidClass() ?>"
    data-table="grade"
    data-field="x_scolastic"
    data-value-separator="<?= $Page->scolastic->displayValueSeparatorAttribute() ?>"
    <?= $Page->scolastic->editAttributes() ?>>
<?= $Page->scolastic->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->scolastic->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
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
