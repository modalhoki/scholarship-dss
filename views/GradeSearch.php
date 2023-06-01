<?php

namespace PHPMaker2021\lpdpdss;

// Page object
$GradeSearch = &$Page;
?>
<script>
var currentForm, currentPageID;
var fgradesearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    <?php if ($Page->IsModal) { ?>
    fgradesearch = currentAdvancedSearchForm = new ew.Form("fgradesearch", "search");
    <?php } else { ?>
    fgradesearch = currentForm = new ew.Form("fgradesearch", "search");
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "grade")) ?>,
        fields = currentTable.fields;
    fgradesearch.addFields([
        ["id", [ew.Validators.integer], fields.id.isInvalid],
        ["awardee", [], fields.awardee.isInvalid],
        ["international", [], fields.international.isInvalid],
        ["national", [], fields.national.isInvalid],
        ["community", [], fields.community.isInvalid],
        ["experience", [], fields.experience.isInvalid],
        ["gpa", [], fields.gpa.isInvalid],
        ["scolastic", [], fields.scolastic.isInvalid],
        ["lgd", [], fields.lgd.isInvalid],
        ["interview", [], fields.interview.isInvalid],
        ["total", [ew.Validators.float], fields.total.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        fgradesearch.setInvalid();
    });

    // Validate form
    fgradesearch.validate = function () {
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
    fgradesearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fgradesearch.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fgradesearch.lists.awardee = <?= $Page->awardee->toClientList($Page) ?>;
    fgradesearch.lists.international = <?= $Page->international->toClientList($Page) ?>;
    fgradesearch.lists.national = <?= $Page->national->toClientList($Page) ?>;
    fgradesearch.lists.community = <?= $Page->community->toClientList($Page) ?>;
    fgradesearch.lists.experience = <?= $Page->experience->toClientList($Page) ?>;
    fgradesearch.lists.gpa = <?= $Page->gpa->toClientList($Page) ?>;
    fgradesearch.lists.scolastic = <?= $Page->scolastic->toClientList($Page) ?>;
    fgradesearch.lists.lgd = <?= $Page->lgd->toClientList($Page) ?>;
    fgradesearch.lists.interview = <?= $Page->interview->toClientList($Page) ?>;
    loadjs.done("fgradesearch");
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
<form name="fgradesearch" id="fgradesearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="grade">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label for="x_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_grade_id"><?= $Page->id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
            <span id="el_grade_id" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id->getInputTextType() ?>" data-table="grade" data-field="x_id" name="x_id" id="x_id" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>" value="<?= $Page->id->EditValue ?>"<?= $Page->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->awardee->Visible) { // awardee ?>
    <div id="r_awardee" class="form-group row">
        <label for="x_awardee" class="<?= $Page->LeftColumnClass ?>"><span id="elh_grade_awardee"><?= $Page->awardee->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_awardee" id="z_awardee" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->awardee->cellAttributes() ?>>
            <span id="el_grade_awardee" class="ew-search-field ew-search-field-single">
<div class="input-group ew-lookup-list">
    <div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_awardee"><?= EmptyValue(strval($Page->awardee->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $Page->awardee->AdvancedSearch->ViewValue ?></div>
    <div class="input-group-append">
        <button type="button" title="<?= HtmlEncode(str_replace("%s", RemoveHtml($Page->awardee->caption()), $Language->phrase("LookupLink", true))) ?>" class="ew-lookup-btn btn btn-default"<?= ($Page->awardee->ReadOnly || $Page->awardee->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_awardee',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
    </div>
</div>
<div class="invalid-feedback"><?= $Page->awardee->getErrorMessage(false) ?></div>
<?= $Page->awardee->Lookup->getParamTag($Page, "p_x_awardee") ?>
<input type="hidden" is="selection-list" data-table="grade" data-field="x_awardee" data-type="text" data-multiple="0" data-lookup="1" data-value-separator="<?= $Page->awardee->displayValueSeparatorAttribute() ?>" name="x_awardee" id="x_awardee" value="<?= $Page->awardee->AdvancedSearch->SearchValue ?>"<?= $Page->awardee->editAttributes() ?>>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->international->Visible) { // international ?>
    <div id="r_international" class="form-group row">
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_grade_international"><?= $Page->international->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_international" id="z_international" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->international->cellAttributes() ?>>
            <span id="el_grade_international" class="ew-search-field ew-search-field-single">
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
    value="<?= HtmlEncode($Page->international->AdvancedSearch->SearchValue) ?>"
    data-type="select-one"
    data-template="tp_x_international"
    data-target="dsl_x_international"
    data-repeatcolumn="5"
    class="form-control<?= $Page->international->isInvalidClass() ?>"
    data-table="grade"
    data-field="x_international"
    data-value-separator="<?= $Page->international->displayValueSeparatorAttribute() ?>"
    <?= $Page->international->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->international->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->national->Visible) { // national ?>
    <div id="r_national" class="form-group row">
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_grade_national"><?= $Page->national->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_national" id="z_national" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->national->cellAttributes() ?>>
            <span id="el_grade_national" class="ew-search-field ew-search-field-single">
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
    value="<?= HtmlEncode($Page->national->AdvancedSearch->SearchValue) ?>"
    data-type="select-one"
    data-template="tp_x_national"
    data-target="dsl_x_national"
    data-repeatcolumn="5"
    class="form-control<?= $Page->national->isInvalidClass() ?>"
    data-table="grade"
    data-field="x_national"
    data-value-separator="<?= $Page->national->displayValueSeparatorAttribute() ?>"
    <?= $Page->national->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->national->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->community->Visible) { // community ?>
    <div id="r_community" class="form-group row">
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_grade_community"><?= $Page->community->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_community" id="z_community" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->community->cellAttributes() ?>>
            <span id="el_grade_community" class="ew-search-field ew-search-field-single">
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
    value="<?= HtmlEncode($Page->community->AdvancedSearch->SearchValue) ?>"
    data-type="select-one"
    data-template="tp_x_community"
    data-target="dsl_x_community"
    data-repeatcolumn="5"
    class="form-control<?= $Page->community->isInvalidClass() ?>"
    data-table="grade"
    data-field="x_community"
    data-value-separator="<?= $Page->community->displayValueSeparatorAttribute() ?>"
    <?= $Page->community->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->community->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->experience->Visible) { // experience ?>
    <div id="r_experience" class="form-group row">
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_grade_experience"><?= $Page->experience->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_experience" id="z_experience" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->experience->cellAttributes() ?>>
            <span id="el_grade_experience" class="ew-search-field ew-search-field-single">
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
    value="<?= HtmlEncode($Page->experience->AdvancedSearch->SearchValue) ?>"
    data-type="select-one"
    data-template="tp_x_experience"
    data-target="dsl_x_experience"
    data-repeatcolumn="5"
    class="form-control<?= $Page->experience->isInvalidClass() ?>"
    data-table="grade"
    data-field="x_experience"
    data-value-separator="<?= $Page->experience->displayValueSeparatorAttribute() ?>"
    <?= $Page->experience->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->experience->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->gpa->Visible) { // gpa ?>
    <div id="r_gpa" class="form-group row">
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_grade_gpa"><?= $Page->gpa->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_gpa" id="z_gpa" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->gpa->cellAttributes() ?>>
            <span id="el_grade_gpa" class="ew-search-field ew-search-field-single">
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
    value="<?= HtmlEncode($Page->gpa->AdvancedSearch->SearchValue) ?>"
    data-type="select-one"
    data-template="tp_x_gpa"
    data-target="dsl_x_gpa"
    data-repeatcolumn="5"
    class="form-control<?= $Page->gpa->isInvalidClass() ?>"
    data-table="grade"
    data-field="x_gpa"
    data-value-separator="<?= $Page->gpa->displayValueSeparatorAttribute() ?>"
    <?= $Page->gpa->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->gpa->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->scolastic->Visible) { // scolastic ?>
    <div id="r_scolastic" class="form-group row">
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_grade_scolastic"><?= $Page->scolastic->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_scolastic" id="z_scolastic" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->scolastic->cellAttributes() ?>>
            <span id="el_grade_scolastic" class="ew-search-field ew-search-field-single">
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
    value="<?= HtmlEncode($Page->scolastic->AdvancedSearch->SearchValue) ?>"
    data-type="select-one"
    data-template="tp_x_scolastic"
    data-target="dsl_x_scolastic"
    data-repeatcolumn="5"
    class="form-control<?= $Page->scolastic->isInvalidClass() ?>"
    data-table="grade"
    data-field="x_scolastic"
    data-value-separator="<?= $Page->scolastic->displayValueSeparatorAttribute() ?>"
    <?= $Page->scolastic->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->scolastic->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->lgd->Visible) { // lgd ?>
    <div id="r_lgd" class="form-group row">
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_grade_lgd"><?= $Page->lgd->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_lgd" id="z_lgd" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->lgd->cellAttributes() ?>>
            <span id="el_grade_lgd" class="ew-search-field ew-search-field-single">
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
    value="<?= HtmlEncode($Page->lgd->AdvancedSearch->SearchValue) ?>"
    data-type="select-one"
    data-template="tp_x_lgd"
    data-target="dsl_x_lgd"
    data-repeatcolumn="5"
    class="form-control<?= $Page->lgd->isInvalidClass() ?>"
    data-table="grade"
    data-field="x_lgd"
    data-value-separator="<?= $Page->lgd->displayValueSeparatorAttribute() ?>"
    <?= $Page->lgd->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->lgd->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->interview->Visible) { // interview ?>
    <div id="r_interview" class="form-group row">
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_grade_interview"><?= $Page->interview->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_interview" id="z_interview" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->interview->cellAttributes() ?>>
            <span id="el_grade_interview" class="ew-search-field ew-search-field-single">
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
    value="<?= HtmlEncode($Page->interview->AdvancedSearch->SearchValue) ?>"
    data-type="select-one"
    data-template="tp_x_interview"
    data-target="dsl_x_interview"
    data-repeatcolumn="5"
    class="form-control<?= $Page->interview->isInvalidClass() ?>"
    data-table="grade"
    data-field="x_interview"
    data-value-separator="<?= $Page->interview->displayValueSeparatorAttribute() ?>"
    <?= $Page->interview->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->interview->getErrorMessage(false) ?></div>
</span>
        </div></div>
    </div>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
    <div id="r_total" class="form-group row">
        <label for="x_total" class="<?= $Page->LeftColumnClass ?>"><span id="elh_grade_total"><?= $Page->total->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_total" id="z_total" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->total->cellAttributes() ?>>
            <span id="el_grade_total" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->total->getInputTextType() ?>" data-table="grade" data-field="x_total" name="x_total" id="x_total" size="30" placeholder="<?= HtmlEncode($Page->total->getPlaceHolder()) ?>" value="<?= $Page->total->EditValue ?>"<?= $Page->total->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->total->getErrorMessage(false) ?></div>
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
    ew.addEventHandlers("grade");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
